<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Pemesanan;
use App\Models\Pengiriman;
use App\Models\ItemPemesanan;
use App\Models\InventoriProduk;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Pemesanan::forUser(\Auth::user())
            ->orderBy('created_at', 'DESC')
            ->paginate(5);

        $this->data['orders'] = $orders;

        $items = \Cart::getContent();
        $this->data['items'] = $items;

        return $this->load_theme('orders.index', $this->data);
    }


    public function show($id)
    {
        $order = Pemesanan::forUser(\Auth::user())->findOrFail($id);
        $this->data['order'] = $order;


        return $this->load_theme('orders.show', $this->data);
    }

    public function checkout()
    {
        if (\Cart::isEmpty()) {
            return redirect('carts');
        }

        \Cart::removeConditionsByType('shipping');
        $this->_updateTax();

        $items = \Cart::getContent();

        $this->data['items'] = $items;
        $this->data['totalWeight'] = $this->getTotalWeight() / 1000;

        $this->data['provinces'] = $this->getProvinces();
        $this->data['cities'] = isset(\Auth::user()->province_id) ? $this->getCities(\Auth::user()->province_id) : [];

        $this->data['user'] = \Auth::user();

        return $this->load_theme('orders.checkout', $this->data);
    }


    public function cities(Request $request)
    {
        $cities = $this->getCities($request->query('province_id'));
        return response()->json(['cities' => $cities]);
    }


    public function shippingCost(Request $request)
    {
        $destination = $request->input('city_id');

        return $this->_getShippingCost($destination, $this->getTotalWeight());
    }


    public function setShipping(Request $request)
    {
        \Cart::removeConditionsByType('shipping');

        $shippingService = $request->get('shipping_service');
        $destination = $request->get('city_id');

        $shippingOptions = $this->_getShippingCost($destination, $this->getTotalWeight());

        $selectedShipping = null;
        if ($shippingOptions['results']) {
            foreach ($shippingOptions['results'] as $shippingOption) {
                if (str_replace(' ', '', $shippingOption['service']) == $shippingService) {
                    $selectedShipping = $shippingOption;
                    break;
                }
            }
        }

        $status = null;
        $message = null;
        $data = [];
        if ($selectedShipping) {
            $status = 200;
            $message = 'Success set shipping cost';

            $this->addShippingCostToCart($selectedShipping['service'], $selectedShipping['cost']);

            $data['total'] = number_format(\Cart::getTotal());
        } else {
            $status = 400;
            $message = 'Failed to set shipping cost';
        }

        $response = [
            'status' => $status,
            'message' => $message
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return $response;
    }


    private function addShippingCostToCart($serviceName, $cost)
    {
        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name' => $serviceName,
            'type' => 'shipping',
            'target' => 'total',
            'value' => '+' . $cost,
        ));

        \Cart::condition($condition);
    }


    private function _getShippingCost($destination, $weight)
    {
        $params = [
            'origin' => env('RAJAONGKIR_ORIGIN'),
            'destination' => $destination,
            'weight' => $weight,
        ];

        $results = [];
        foreach ($this->couriers as $code => $courier) {
            $params['courier'] = $code;

            $response = $this->rajaOngkirRequest('cost', $params, 'POST');

            if (!empty($response['rajaongkir']['results'])) {
                foreach ($response['rajaongkir']['results'] as $cost) {
                    if (!empty($cost['costs'])) {
                        foreach ($cost['costs'] as $costDetail) {
                            $serviceName = strtoupper($cost['code']) . ' - ' . $costDetail['service'];
                            $costAmount = $costDetail['cost'][0]['value'];
                            $etd = $costDetail['cost'][0]['etd'];

                            $result = [
                                'service'   => $serviceName,
                                'cost'      => $costAmount,
                                'etd'       => $etd,
                                'courier'   => $code,
                            ];

                            $results[] = $result;
                        }
                    }
                }
            }
        }

        $response = [
            'origin'        => $params['origin'],
            'destination'   => $destination,
            'weight'        => $weight,
            'results'       => $results,
        ];

        return $response;
    }


    private function getTotalWeight()
    {
        if (\Cart::isEmpty()) {
            return 0;
        }

        $totalWeight = 0;
        $items = \cart::getContent();

        foreach ($items as $item) {
            $totalWeight = ($item->quantity * $item->associatedModel->berat);
        }

        return $totalWeight;
    }

    private function _getSelectedShipping($destination, $totalWeight, $shippingService)
    {
        $shippingOptions = $this->_getShippingCost($destination, $totalWeight);

        $selectedShipping = null;
        if ($shippingOptions['results']) {
            foreach ($shippingOptions['results'] as $shippingOption) {
                if (str_replace(' ', '', $shippingOption['service']) == $shippingService) {
                    $selectedShipping = $shippingOption;
                    break;
                }
            }
        }

        return $selectedShipping;
    }


    private function _updateTax()
    {
        \Cart::removeConditionsByType('tax');

        $condition = new \Darryldecode\Cart\CartCondition(array(
            'name'      => 'TAX 0%',
            'type'      => 'tax',
            'target'    => 'total',
            'value'     => '0%',
        ));

        \Cart::condition($condition);
    }

    private function _getTotalWeight()
    {
        if (\Cart::isEmpty()) {
            return 0;
        }

        $totalWeight = 0;
        $items = \Cart::getContent();

        foreach ($items as $item) {
            $totalWeight += ($item->quantity * $item->associatedModel->berat);
        }

        return $totalWeight;
    }


    public function doCheckout(OrderRequest $request)
    {
        $params = $request->except('_token');
        $order = \DB::transaction(
            function () use ($params) {
                $order = $this->_saveOrder($params);
                $this->_saveOrderItems($order);
                $this->_generatePaymentToken($order);
                $this->_saveOrderShipments($order, $params);

                return $order;
            }
        );

        if ($order) {
            \Cart::clear();
            $this->_sendEmailOrderReceived($order);

            \Session::flash('success', 'Thank you. Your order has been received!');
            return redirect('orders/received/' . $order->id);
        }

        return redirect('orders/checkout');
    }


    private function _generatePaymentToken($order)
    {
        $this->initPaymentGateway();

        $customerdetails = [
            'first_name'    => $order->nama_depan_konsumen,
            'last_name'     => $order->nama_belakang_konsumen,
            'email'         => $order->email_konsumen,
            'phone'         => $order->no_hp_konsumen,
        ];

        $params = [
            'enable_payments'     => \App\Models\Pembayaran::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id'      => $order->kode,
                'gross_amount'  => $order->total_akhir,
            ],
            'customer_details'  => $customerdetails,
            'expiry' => [
                'start_time'    => date('Y-m-d H:i:s T'),
                'unit'          => \App\Models\Pembayaran::EXPIRY_UNIT,
                'duration'      => \App\Models\Pembayaran::EXPIRY_DURATION,
            ],
        ];

        $snap = \Midtrans\Snap::createTransaction($params);

        if ($snap->token) {
            $order->token_pembayaran = $snap->token;
            $order->url_pembayaran = $snap->redirect_url;
            $order->save();
        }
    }


    private function _saveOrder($params)
    {
        $destination = isset($params['ship_to']) ? $params['kota_id_pengiriman'] : $params['kota_id'];
        $selectedShipping = $this->_getSelectedShipping($destination, $this->getTotalWeight(), $params['layanan_kurir']);

        $baseTotalPrice = \Cart::getSubTotal();  // total awal
        $taxAmount = \Cart::getCondition('TAX 0%')->getCalculatedValue(\Cart::getSubTotal());
        $taxPercent = (float)\Cart::getCondition('TAX 0%')->getValue();
        $shippingCost = $selectedShipping['cost'];
        $grandTotal = ($baseTotalPrice + $taxAmount + $shippingCost);

        $orderDate = date('Y-m-d H:i:s');
        $paymentDue = (new \DateTime($orderDate))->modify('+1 day')->format('Y-m-d H:i:s');

        $orderParams = [
            'user_id'                  => \Auth::user()->id,
            'kode'                     => Pemesanan::generateCode(),
            'status'                   => Pemesanan::CREATED,
            'tanggal_pemesanan'        => $orderDate,
            'batas_pembayaran'          => $paymentDue,
            'status_pembayaran'         => Pemesanan::UNPAID,
            'total_awal'               => $baseTotalPrice,
            'jumlah_pajak'             => $taxAmount,
            'persen_pajak'             => $taxPercent,
            'biaya_pengiriman'         => $shippingCost,
            'total_akhir'              => $grandTotal,
            'catatan'                  => $params['catatan'],
            'nama_depan_konsumen'      => $params['nama_depan'],
            'nama_belakang_konsumen'   => $params['nama_belakang'],
            'alamat_konsumen'          => $params['alamat'],
            'no_hp_konsumen'           => $params['no_hp'],
            'email_konsumen'           => $params['email'],
            'kota_konsumen'            => $params['kota_id'],
            'provinsi_konsumen'        => $params['provinsi_id'],
            'kodepos_konsumen'        => $params['kode_pos'],
            'nama_kurir'               => $selectedShipping['courier'],
            'layanan_kurir'            => $selectedShipping['service'],
        ];

        return Pemesanan::create($orderParams);
    }


    private function _saveOrderItems($order)
    {
        $cartItems = \Cart::getContent();

        if ($order && $cartItems) {
            foreach ($cartItems as $item) {
                $itemTaxAmount = 0;
                $itemTaxPercent = 0;
                $itemBaseTotal = $item->quantity * $item->price;
                $itemSubTotal = $itemBaseTotal + $itemTaxAmount;

                $product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;

                $orderItemParams = [
                    'pemesanan_id'      => $order->id,
                    'produk_id'         => $item->associatedModel->id,
                    'qty'               => $item->quantity,
                    'harga'             => $item->price,
                    'total_harga'       => $itemBaseTotal,
                    'jumlah_pajak'      => $itemTaxAmount,
                    'persen_pajak'      => $itemTaxPercent,
                    'sub_total'         => $itemSubTotal,
                    'sku'               => $item->associatedModel->sku,
                    'tipe'              => $product->tipe,
                    'nama_produk'       => $item->name,
                    'berat'             => $item->associatedModel->berat,
                    'atribut'           => json_encode($item->attributes),
                ];

                $orderItem = ItemPemesanan::create($orderItemParams);

                if ($orderItem) {
                    InventoriProduk::reduceStock($orderItem->produk_id, $orderItem->qty);
                }
            }
        }
    }

    private function _saveOrderShipments($order, $params)
    {
        $shippingFirstName  = isset($params['ship_to']) ? $params['nama_depan_pengiriman'] : $params['nama_depan'];
        $shippingLastName   = isset($params['ship_to']) ? $params['nama_belakang_pengiriman'] : $params['nama_belakang'];
        $shippingAddress    = isset($params['ship_to']) ? $params['alamat_pengiriman'] : $params['alamat'];
        $shippingPhone      = isset($params['ship_to']) ? $params['no_hp_pengiriman'] : $params['no_hp'];
        $shippingEmail      = isset($params['ship_to']) ? $params['email_pengiriman'] : $params['email'];
        $shippingCityId     = isset($params['ship_to']) ? $params['kota_id_pengiriman'] : $params['kota_id'];
        $shippingProvinceId = isset($params['ship_to']) ? $params['provinsi_id_pengiriman'] : $params['provinsi_id'];
        $shippingPostcode   = isset($params['ship_to']) ? $params['kode_pos_pengiriman'] : $params['kode_pos'];

        $shipmentParams = [
            'user_id' => \Auth::user()->id,
            'pemesanan_id' => $order->id,
            'status' => Pengiriman::PENDING,
            'total_qty' => \Cart::getTotalQuantity(),
            'total_berat' => $this->_getTotalWeight(),
            'nama_depan' => $shippingFirstName,
            'nama_belakang' => $shippingLastName,
            'alamat' => $shippingAddress,
            'no_hp' => $shippingPhone,
            'email' => $shippingEmail,
            'kota_id' => $shippingCityId,
            'provinsi_id' => $shippingProvinceId,
            'kodepos' => $shippingPostcode,
        ];

        Pengiriman::create($shipmentParams);
    }

    private function _sendEmailOrderReceived($order)
    {
        // $message = new \App\Mail\OrderReceived($order);
        // \Mail::to(\Auth::user()->email)->send($message);

        \App\Jobs\SendMailOrderReceived::dispatch($order, \Auth::user());
    }

    public function received($orderId)
    {
        $this->data['order'] = Pemesanan::where('id', $orderId)
            ->where('user_id', \Auth::user()->id)
            ->firstOrFail();




        return $this->load_theme('orders/received', $this->data);
    }
}
