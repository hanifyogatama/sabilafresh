@extends('admin.layout')

@section('content')
<div class="section-header">

    <div class="col-lg-10">
        <h1>Dashboard</h1>
    </div>
    <div class="col-lg-2 ml-5">

        @role('Admin')
        <span class="badge badge-info">Admin</span>
        @endrole
        @role('Owner')
        <span class="badge badge-danger">Owner</span>
        @endrole

    </div>
</div>

<!-- admin  -->
<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="fas fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>User</h4>
                </div>
                <div class="card-body">
                    <div class="mt-1" style="font-size: 12px;">
                        <span>Admin : {{ $admins->count() }}</span>
                        <span>Owner : {{ $owners->count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="fas fa-users"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Pelanggan</h4>
                </div>
                <div class="card-body">
                    {{ $customers->count() }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="fas fa-box"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Produk</h4>
                </div>
                <div class="card-body">
                    {{ $products->count() }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4></h4>
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- list kategori -->







<!-- produk -->








<!-- report orders -->
<!-- <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-stats">
                <div class="card-stats-title mb-0 font-weight-bold">Statistik Penjualan
                </div>
                <div class="card-stats-items">
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">24</div>
                        <div class="card-stats-item-label">Pending</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">12</div>
                        <div class="card-stats-item-label">Shipping</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">23</div>
                        <div class="card-stats-item-label">Completed</div>
                    </div>
                </div>
            </div>
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-archive"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pemesanan</h4>
                </div>
                <div class="card-body">
                    59
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-chart">
                <canvas id="balance-chart" height="80"></canvas>
            </div>
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Balance</h4>
                </div>
                <div class="card-body">
                    $187,13
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-chart">
                <canvas id="sales-chart" height="80"></canvas>
            </div>
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Sales</h4>
                </div>
                <div class="card-body">
                    4,732
                </div>
            </div>
        </div>
    </div>
</div> -->


<!-- chart -->
<!-- <div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Budget vs Sales</h4>
            </div>
            <div class="card-body">
                <canvas id="myChart" height="158"></canvas>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-lg-4 p-0"></div>
    <div class="col-lg-4 p-0"></div>
    <div class="col-lg-4 p-0">
        <div class="card gradient-bottom">
            <div class="card-header">
                <h4>Produk Terbaru</h4>
            </div>
            <div class="card-body" id="top-5-scroll">
                @forelse ($products as $product)
                <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                        @if ($product->gambarProduk->first())
                        <img src="{{ asset('storage/'.$product->gambarProduk->first()->path) }}" alt="{{ $product->nama }}" width="55" class="mr-3 rounded">
                        @else
                        <img src="{{ asset('themes/sabilafresh/assets/img/product/fashion-colorful/1.jpg') }}" alt="{{ $product->nama }}" width="55" class="mr-3 rounded">
                        @endif

                        <div class="media-body">
                            <div class="float-right">
                                <div class="font-weight-600 text-muted text-small">Rp {{ number_format($product->price_label()) }}</div>
                            </div>
                            <div class="media-title">{{ Str::limit($product->nama,15)}}</div>
                            <div class="mt-1">
                                <div class="budget-price ">
                                    <div class="budget-price-label ml-0">kategori</div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                @empty
                Produk Kosong!
                @endforelse
            </div>
            <div class="card-footer d-flex justify-content-center">
                @role('Admin')
                <a href="{{ url('admin/products')}}" class="budget-price-label">Lihat semua</a>
                @endrole
            </div>

        </div>
    </div>
</div>




</div>



@stop