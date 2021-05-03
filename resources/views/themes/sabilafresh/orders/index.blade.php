@extends('themes.sabilafresh.layout')

@section('content')

<div class="shadow rounded-lg shop-page-wrapper shop-page-padding ptb-150">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                @include('themes.sabilafresh.partials.user_menu')
            </div>
            <div class="col-lg-9">

                <div class="d-flex justify-content-between mb-2">
                    <h5 class="row ml-1" style="font-weight: 500; color: #6C727C;"><i class="fa fa-credit-card" style="font-size:22px ; color: #6C727C; margin-right: 10px;"></i>Semua Transaksi</h5>
                </div>

                @include('admin.partials.flash')

                @include('themes.sabilafresh.orders.list_view')

            </div>
        </div>
    </div>
</div>
@endsection