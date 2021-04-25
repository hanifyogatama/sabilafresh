<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Authorizable;
use App\Models\Pemesanan;
use App\Models\Pengiriman;

class ShipmentController extends Controller
{

    use Authorizable;

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $shipments = Pengiriman::join('pemesanan', 'shipments.order_id', '=', 'orders.id')
        //     ->whereRaw('orders.deleted_at IS NULL')
        //     ->orderBy('shipments.created_at', 'DESC')->paginate(10);
        // $this->data['shipments'] = $shipments;

        // return view('admin.shipments.index', $this->data);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipment = Pengiriman::findOrFail($id);
        $this->data['shipment'] = $shipment;
        $this->data['provinces'] = $this->getProvinces();
        $this->data['cities'] = isset($shipment->provinsi) ? $this->getCities($shipment->provinsi) : [];

        return view('admin.shipments.edit', $this->data);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'no_resi' => 'required|max:255',
            ]
        );

        $shipment = Pengiriman::findOrFail($id);

        $order = \DB::transaction(
            function () use ($shipment, $request) {
                $shipment->no_resi = $request->input('no_resi');
                $shipment->status = Pengiriman::SHIPPED;
                $shipment->shipped_at = now();
                $shipment->shipped_by = \Auth::user()->id;

                if ($shipment->save()) {
                    $shipment->pemesanan->status = Pemesanan::DELIVERED;
                    $shipment->pemesanan->save();
                }

                return $shipment->pemesanan;
            }
        );

        if ($order) {
            $this->_sendEmailOrderShipped($shipment->pemesanan);
        }

        \Session::flash('success', 'The shipment has been updated');
        return redirect('admin/orders/' . $order->id);
    }

    private function _sendEmailOrderShipped($order)
    {
        \App\Jobs\SendMailOrderShipped::dispatch($order);
    }
    
}
