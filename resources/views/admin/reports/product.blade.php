@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1>Laporan Produk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-chart-bar"></i></i> Laporan</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/reports/product')}}">Produk</a></div>
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
                            <th>Kode Barang</th>
                            <th>Nama Produk</th>
                            <th>Produk Terjual</th>
                            <th>Pendapatan</th>
                            <th>Stok</th>
                        </thead>
                        <tbody>
                            @php
                            $totalNetRevenue = 0;
                            @endphp
                            @forelse ($products as $product)
                            <tr>
                                <td>{{ $product->sku }}</td>
                                <td>{{ $product->nama_produk }}</td>
                                <td>{{ $product->items_sold }}</td>
                                <td>Rp {{ \General::priceFormat($product->net_revenue) }}</td>
                                <td>{{ $product->stock }}</td>
                            </tr>

                            @php
                            $totalNetRevenue += $product->net_revenue;
                            @endphp
                            @empty
                            <tr>
                                <td colspan="6">Data tidak tersedia</td>
                            </tr>
                            @endforelse

                            @if ($products)
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>Rp {{ \General::priceFormat($totalNetRevenue) }}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection