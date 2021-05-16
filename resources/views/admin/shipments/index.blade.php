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
    <div class="row ">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-body">
                    @include('admin.partials.flash')
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th>Kode Pemesanan</th>
                            <th>Status Pemesanan</th>
                            <th>Tujuan</th>
                            <th>Status Pengiriman</th>
                            <th>Total (gram)</th>
                        </thead>
                        <tbody>
                            @forelse ($shipments as $shipment)
                            <tr>
                                <td>
                                    {{ $shipment->pemesanan->kode }}<br>
                                    <span style="font-size: 12px; font-weight: normal"> {{\General::datetimeFormat($shipment->pemesanan->tanggal_pemesanan)}}</span>
                                </td>

                                <td>
                                    @if($shipment->pemesanan->status == 'cancelled')
                                    {{ $shipment->pemesanan->status }}
                                    <br>
                                    <span style="font-size: 12px; font-weight: normal">
                                        {{\General::datetimeFormat($shipment->pemesanan->cancelled_at)}}
                                    </span>
                                    @elseif($shipment->pemesanan->status == 'completed')
                                    {{ $shipment->pemesanan->status }}
                                    <br>
                                    <span style="font-size: 12px; font-weight: normal">
                                        {{\General::datetimeFormat($shipment->pemesanan->approved_at)}}
                                    </span>
                                    @else
                                    {{ $shipment->pemesanan->status }}
                                    @endif
                                </td>

                                <td>{{ $shipment->nama_depan }} {{ $shipment->nama_belakang }}</td>

                                <td>
                                    @if($shipment->pemesanan->status == 'cancelled')
                                    <span>{{ $shipment->status }}</span>
                                    @else
                                    {{ $shipment->status }}
                                    <br>
                                    <span style="font-size: 12px; font-weight: normal">
                                        {{\General::datetimeFormat($shipment->shipped_at)}}
                                    </span>
                                    @endif
                                </td>

                                <td>{{ $shipment->total_berat }}</td>
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