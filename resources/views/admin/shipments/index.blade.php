@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Pengiriman</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-shopping-cart"></i></i> Cek Pemesanan</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/shipments')}}">Pengiriman</a></div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-body">
                    @include('admin.partials.flash')
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th>Id Pemesanan</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Total Qty</th>
                            <th>Berat Total (gram)</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($shipments as $shipment)
                            <tr>
                                <td>
                                    {{ $shipment->pemesanan->kode }}<br>
                                    <span style="font-size: 12px; font-weight: normal"> {{\General::datetimeFormat($shipment->pemesanan->tanggal_pemesanan)}}</span>
                                </td>
                                <td>{{ $shipment->pemesanan->nama_depan_konsumen }} {{ $shipment->pemesanan->nama_belakang_konsumen }}</td>
                                <td>
                                    {{ $shipment->status }}
                                    <br>
                                    <span style="font-size: 12px; font-weight: normal">
                                        {{\General::datetimeFormat($shipment->shipped_at)}}
                                    </span>
                                </td>
                                <td>{{ $shipment->total_qty }}</td>
                                <td>{{ \General::priceFormat($shipment->total_berat) }}</td>
                                <td>
                                    @can('edit_orders')
                                    <!-- <a href="{{ url('admin/orders/'. $shipment->pemesanan->id) }}" class="btn btn-info btn-sm">show</a> -->
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
                    {{ $shipments->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection