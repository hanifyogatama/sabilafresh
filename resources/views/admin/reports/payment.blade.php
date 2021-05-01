@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Laporan Pembayaran</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-chart-bar"></i></i> Laporan</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/reports/payment')}}">Pembayaran</a></div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-body">
                    @include('admin.partials.flash')
                    @include('admin.reports.filter')
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>ID Pemesanan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th>Tipe Pembayaran</th>

                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                            <tr>
                                <td>{{ $payment->kode }}</td>
                                <td>{{ \General::datetimeFormat($payment->created_at) }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>{{ \General::priceFormat($payment->jumlah) }}</td>
                                <td>{{ $payment->tipe_pembayaran }}</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection