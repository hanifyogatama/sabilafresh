@extends('themes.sabilafresh.layout')

@section('content')

<div class="shop-page-wrapper shop-page-padding ptb-140">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                @include('themes.sabilafresh.products.sidebar')
            </div>
            <div class="col-lg-9">
                <div class="shop-product-wrapper res-xl">
                    <div class="shop-bar-area">
                        <div style="margin-top: 35px;">
                            <hr />
                        </div>
                        <div class="row mt-4 mb-2">
                            <div class="col-lg-7">
                                <p style="font-size: 13px; color: #03AC0E;">Menampilkan {{ count($products) }} produk dari total {{ $products->total() }} produk</p>
                            </div>
                            <div class="col-lg-5">
                                <div class="shop-selector">
                                    <label>Urutkan: </label>
                                    {{ Form::select('sort', $sorts , $selectedSort ,array('onChange' => 'this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);')) }}
                                </div>
                            </div>

                        </div>
                        <div class="shop-product-content tab-content">
                            <div id="grid-sidebar3" class="tab-pane fade active show">
                                @include('themes.sabilafresh.products.grid_view')
                            </div>
                            <div id="grid-sidebar4" class="tab-pane fade">
                                @include('themes.sabilafresh.products.list_view')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-50 text-center">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection