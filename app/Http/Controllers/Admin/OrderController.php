<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Exceptions\OutOfStock;
use App\Authorizable;
use App\Models\Pemesanan;
use App\Models\ItemPemesanan;
use App\Models\InventoriProduk;

class OrderController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        $this->data['statuses'] = Pemesanan::STATUSES;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Pemesanan::orderBy('created_at', 'desc');

        $searchInput = $request->input('searchInput');
        if ($searchInput) {
            $orders = $orders->where('kode', 'like', '%' . $searchInput . '%')
                ->orWhere('nama_depan_konsumen', 'like', '%' . $searchInput . '%')
                ->orWhere('nama_belakang_konsumen', 'like', '%' . $searchInput . '%');
        }

        if ($request->input('status') && in_array($request->input('status'), array_keys(Pemesanan::STATUSES))) {
            $orders = $orders->where('status', '=', $request->input('status'));
        }

        $startdate = $request->input('start');
        $endDate = $request->input('end');

        if ($startdate && !$endDate) {
            \Session::flash('error', 'masukkan tanggal akhir jika tangal awal sekarang');
            return redirect('admin/orders');
        }

        if (!$startdate && $endDate) {
            \Session::flash('error', 'masukkan tanggal awal jika tanggal akhir sekarang');
            return redirect('admin/orders');
        }

        if ($startdate && $endDate) {
            if (strtotime($endDate) < strtotime($startdate)) {
                \Session::flash('error', 'tanggal akhir harus lebih besar dari tanggal awal');
                return redirect('admin/orders');
            }

            $order = $orders->whereRaw("DATE(tanggal_pemesanan) >= ?", $startdate)
                ->whereRaw("DATE(tanggal_pemesanan) <= ?", $endDate);
        }

        $this->data['orders'] = $orders->paginate(10);

        return view('admin.orders.index', $this->data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $this->data['orders'] = Pemesanan::onlyTrashed()->orderBy('crated_at', ' DESC')->paginate(10);

        return view('admin.orders.trashed', $this->date);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Pemesanan::withTrashed()->findOrFail($id);

        $this->data['order'] = $order;

        return view('admin.orders.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $order = Pemesanan::where('id', $id)
            ->whereIn('status', [Pemesanan::CREATED, Pemesanan::CONFIRMED])
            ->firstOrFail();

        $this->data['order'] = $order;

        return view('admin.orders.cancel', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function doCancel(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'catatan_pembatalan' => 'required|max:255',
            ], 
            [
                'catatan_pembatalan.required' => 'catatan pembatalan belum diisi',
            ]
        );

        $order = Pemesanan::findOrFail($id);

        $cancelOrder = \DB::transaction(
            function () use ($order, $request) {
                $params = [
                    'status' => Pemesanan::CANCELLED,
                    'cancelled_by' => \Auth::user()->id,
                    'cancelled_at' => now(),
                    'catatan_pembatalan' => $request->input('catatan_pembatalan'),
                ];

                if ($cancelOrder = $order->update($params) && $order->itemPemesanan->count() > 0) {
                    foreach ($order->itemPemesanan as $item) {
                        InventoriProduk::increaseStock($item->produk_id, $item->qty);
                    }
                }

                return $cancelOrder;
            }
        );

        \Session::flash('success', 'pemesanan berhasil di batalkan');

        return redirect('admin/orders');
    }


    public function doComplete(Request $request, $id)
    {
        $order = Pemesanan::findOrFail($id);

        if (!$order->isDelivered()) {
            \Session::flash('error', 'data belum selesai di proses');
            return redirect('admin/orders');
        }

        $order->status = Pemesanan::COMPLETED;
        $order->approved_by = \Auth::user()->id;
        $order->approved_at = now();

        if ($order->save()) {
            \Session::flash('success', 'Status pemesanan telah selesai');
            return redirect('admin/orders');
        }
    }
}
