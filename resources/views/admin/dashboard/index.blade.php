@extends('admin.layout')

@section('content')
<div class="section-header">

    <div class="col-lg-10">
        <h1>Dashboard</h1>
    </div>
    <div class="col-lg-2 ml-5">
        @role('Admin')
        <span class="badge btn-info">Admin</span>
        @endrole
        @role('Owner')
        <span class="badge btn-danger">Owner</span>
        @endrole

    </div>
</div>

<!-- admin  -->
<div class="row">
    <div class="col my-auto">
        <div class="card card-hero">
            <div class=" card-header">
                <div class="card-icon">
                    <img class="mx-auto " src="{{ asset('themes/sabilafresh/assets/img/front/bag-fruits.svg') }}" alt="" width="180px">
                </div>
                <div class="card-description font-weight-bold">Selamat Datang {{ \Auth::user()->nama_depan }}</div>
                <div class="text">
                    @php
                    date_default_timezone_set('Asia/Jakarta');
                    $Hour = date('G');
                    @endphp
                    @if($Hour >= 5 && $Hour <= 11) <div>
                        <h5>Selamat Pagi</h5>
                        <i class="pl-5 pt-3 fa fa-cloud-sun fa-4x"></i>
                </div>
                @elseif($Hour >= 12 && $Hour <= 18) <div>
                    <h5>Selamat Siang</h5>
                    <i class="pl-5 pt-3 fa fa-sun fa-4x"></i>
            </div>
            @elseif($Hour >= 18 || $Hour <= 4) <div>
                <h5>Selamat Malam</h5>
                <i class="pl-5 pt-3 fa fa-cloud-moon fa-4x"></i>
        </div>
        @endif
    </div>
</div>
</div>
</div>

<div class="col">
    <div class="row">
        <div class="col">
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

        <div class="col">
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

    </div>
    <div class="row">
        <div class="col">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-box"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Produk</h4>
                    </div>
                    <div class="card-body">
                        {{ $product->count() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>User Aktif</h4>
                    </div>
                    <div class="card-body">
                        @php
                        $userTotal = 0;
                        @endphp
                        @foreach($users as $user)
                        @php
                        if($user->isOnline()){
                        $userTotal = $userTotal +1;
                        }
                        @endphp
                        @endforeach
                        {{ ($userTotal) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- list user active -->
<div class="row ">
    <div class="col">
        <div class="card ">
            <div class="row pt-2">
                <div class="col-sm-10">
                    <h6 class="text-dark pl-4">User Aktif</h6>
                </div>
                @if($users->count() >= 5)
                <div class="col"><a href="{{ url('admin/users') }}" class="btn btn-round btn-primary px-3 py-0">Lihat Semua</a></div>
                @endif
            </div>
            <div class="card-body d-flex justify-content-start mt-0 pt-0">



                @forelse($users->take(5) as $user)
                @if($user->isOnline())
                <div class="media  mr-3 p-2 rounded shadow-sm">
                    <img alt="image" src="{{ URL::asset('admin/assets/img/avatar/profile-1.png') }}" class="mr-3 rounded-circle shadow-sm" width="50">
                    <div class="media-body">
                        <h6 class="media-title text-capitalize"><span>{{ Str::limit($user->nama_depan,13) }}</span></h6>
                        <div class="text-small text-muted">
                            @if ($user->roles->contains('name', 'Admin'))
                            <span class="text-dark">{{ $user->roles->implode('name', ', ') }}</span>
                            @elseif ($user->roles->contains('name', 'Owner'))
                            <span class="text-dark">{{ $user->roles->implode('name', ', ') }}</span>
                            @else
                            <span class="text-dark">Pelanggan</span>
                            @endif

                            <div class="bullet text-success"></div>
                            @if($user->isOnline())
                            <span class="text-primary font-weight-bold">Online</span>
                            @endif
                            <!-- <div class="text-primary">Login : 13 menit yang lalu</div> -->
                        </div>
                    </div>
                </div>
                @endif
                @empty
                Data tidak tersedia
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- end list user active -->



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

    </div>
</div> -->

<div class="row">
    <div class="col-lg-8 ">
        <!-- <div class="card">
            <div class="card-header">
                <h4 style="color: #03AC0E;">Budget vs Sales</h4>
            </div>
            <div class="card-body">
                <canvas id="myChart" height="158"></canvas>
            </div>
        </div> -->
    </div>

    <div class="col-lg-4">
        <div class="card gradient-bottom">
            <div class="card-header">
                <h4 class="d-inline text-dark">Produk Terbaru</h4>
                <div class="card-header-action">
                    @role('Admin')
                    <a href="{{ url('admin/products')}}" class="btn btn-primary py-0">Lihat Semua</a>
                    @endrole
                </div>
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
                                <div class="font-weight-600 text-small" style="color: #03AC0E;">Rp {{ number_format($product->price_label()) }}</div>
                            </div>
                            <div class="media-title text-capitalize">{{ Str::limit($product->nama,12)}}</div>
                            <div class="mt-1">
                                <div class="budget-price ">
                                    <div class="budget-price-label ml-0">{{ $product->getTimeAgo($product->created_at) }}</div>
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
            </div>
        </div>
    </div>
</div>

<!-- category list -->

<div class="row">
    <div class="col">
        <div class="card ">
            <div class="row pt-2">
                <div class="col-sm-10">
                    <h6 class="text-dark pl-4 pb-3">Kategori Produk <span class="py-1 badge badge-primary">{{$categories->count()}}</span></h6>
                </div>
                @if($categories->count() >= 6)
                <div class="col"><a href="{{ url('admin/categories') }}" class="btn btn-round btn-primary px-3 py-0">Lihat Semua</a></div>
                @endif
            </div>
            <div class="card-body d-flex justify-content-start mt-0 pt-0">
                @forelse($categories as $category)
                <div class="media mr-3 p-2  shadow-sm btn-round">
                    <div class="row">
                        <div class="col-sm-3 pt-1">
                            <div class="btn btn-outline-primary shadow-sm border btn-custom" style="border-radius: 50%;">{{ $category->produks->count() }}</div>
                        </div>
                        <div class="col">
                            <div class="media-body pt-2 pl-2">
                                <h6 class="text-muted text-capitalize text-small"><span>{{ Str::limit($category->nama,14)}}</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                Data tidak tersedia
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- end category list -->


<!-- <div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>Best Products</h4>
            </div>
            <div class="card-body">
                <div class="owl-carousel owl-theme" id="products-carousel">
                    <div>
                        <div class="product-item pb-3">
                            <div class="product-image">
                                <img alt="image" src="https://i.pinimg.com/originals/20/c9/e0/20c9e0a5110642b2c3bb88d7546c13f3.png" class="img-fluid">
                            </div>
                            <div class="product-details">
                                <div class="product-name">iBook Pro 2018</div>
                                <div class="product-review">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <div class="text-muted text-small">67 Sales</div>
                                <div class="product-cta">
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-item">
                            <div class="product-image">
                                <img alt="image" src="https://i.pinimg.com/originals/20/c9/e0/20c9e0a5110642b2c3bb88d7546c13f3.png" class="img-fluid">
                            </div>
                            <div class="product-details">
                                <div class="product-name">oPhone S9 Limited</div>
                                <div class="product-review">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half"></i>
                                </div>
                                <div class="text-muted text-small">86 Sales</div>
                                <div class="product-cta">
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product-item">
                            <div class="product-image">
                                <img alt="image" src="https://i.pinimg.com/originals/20/c9/e0/20c9e0a5110642b2c3bb88d7546c13f3.png" class="img-fluid">
                            </div>
                            <div class="product-details">
                                <div class="product-name">Headphone Blitz</div>
                                <div class="product-review">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <div class="text-muted text-small">63 Sales</div>
                                <div class="product-cta">
                                    <a href="#" class="btn btn-primary">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div> -->
@stop