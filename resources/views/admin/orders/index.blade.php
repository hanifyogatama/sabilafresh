@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Pemesanan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-shopping-cart"></i></i> Cek Pemesanan</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/orders')}}">Pemesanan</a></div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-body">
                    @include('admin.partials.flash')
                    @include('admin.orders.filter')
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th>Kode Pemesanan</th>
                            <th>Total</th>
                            <th>Nama Konsumen</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td>
                                    {{ $order->kode }}<br>
                                    <span style="font-size: 12px; font-weight: normal"> {{\General::datetimeFormat($order->tanggal_pemesanan) }}</span>
                                </td>
                                <td>Rp {{\General::priceFormat($order->total_akhir) }}</td>
                                <td>
                                    {{ $order->nama_depan_konsumen}} {{ $order->nama_belakang_konsumen}}<br>
                                    <span style="font-size: 12px; font-weight: normal"> {{ $order->email_konsumen }}</span>
                                </td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->status_pembayaran }}</td>
                                <td>
                                    @can('edit_orders')
                                    <a href="{{ url('admin/orders/'. $order->id) }}" class="btn btn-info btn-sm">Detail</a>
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Data tidak tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection