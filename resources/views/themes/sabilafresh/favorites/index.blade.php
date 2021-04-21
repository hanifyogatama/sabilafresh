@extends('themes.sabilafresh.layout')

@section('content')

<div class="shop-page-wrapper shop-page-padding ptb-150">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                @include('themes.sabilafresh.partials.user_menu')
            </div>
            <div class="col-lg-9">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="row ml-1" style="font-weight: 500; color: #6C727C;"><i style="font-size:22px ; color: #6C727C; margin-right: 10px;" class="fa fa-heart"></i>Wishlist</h5>
                </div>

                @include('admin.partials.flash')

                @include('themes.sabilafresh.favorites.grid_view')
            </div>
        </div>
    </div>
</div>
@endsection