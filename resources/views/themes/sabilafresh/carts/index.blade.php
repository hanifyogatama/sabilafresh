@extends('themes.sabilafresh.layout')

@section('content')

<!-- shopping-cart-area start -->
<div class="cart-main-area ptb-120 ml-90 mr-70">
    <div class="container-fluid">
        <h5 class="" style="font-weight: 600;">Keranjang</h5>

        <div class="row">
            <div class="col-lg-7">

                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                {!! Form::open(['url' => 'carts/update']) !!}

                @if(!$items->isEmpty())
                @foreach ($items as $item)
                <div class="pt-10">
                    <hr />
                </div>
                @php
                $product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
                $image = !empty($product->gambarProduk->first()) ? asset('storage/'.$product->gambarProduk->first()->path) : asset('themes/sabilafresh/assets/img/cart/3.jpg')
                @endphp


                <div class="row">
                    <div class="col-md-1">
                        <div class="product-thumbnail">
                            <a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:70px ;border-radius: 10%;"></a>
                        </div>
                    </div>
                    <div class="col-md-11 pl-5 pr-5 mt-1">
                        <a href="{{ url('product/'. $product->slug) }}">{{ Str::limit($item->name,45) }}</a>
                        <h6 style="font-weight: 600;" class="amount">Rp {{ number_format($item->price) }}</h6>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-2 pl-5">
                        <a href="{{ url('carts/remove/'. $item->id)}}" class="delete"><i style="font-size: 20px; font-weight: bold;" class="ti-trash"></i></a>
                    </div>

                    <div class="col-md-2 pr-5">
                        <div class="product-quantity ">
                            {{-- <input name="" value="{{ $item->quantity }}" type="number" min="1" > --}}
                            {!! Form::number('items['. $item->id .'][quantity]', $item->quantity, ['min' => 1, 'required' => true], ['style'=>'height:10px']) !!}
                        </div>
                    </div>

                </div>
                <!-- <div class="product-price-cart"></div> -->
                <!-- <div class="product-subtotal">Rp {{ number_format($item->price * $item->quantity)}}</div> -->
                @endforeach
                <div class="pt-20">
                    <hr />
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="coupon-all">
                            <div class="coupon2">
                                <input style="color: white;" class="btn btn-light-green btn-sm" name="update_cart" value="Update" type="submit">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- start favorite section -->

                <!-- end favorite section -->
            </div>

            <div class="shadow fixed-column rounded-lg ">
                <h6 class="pl-4 mt-3 mb-3" style="font-weight: 600;">Ringkasan belanja</h6>

                <div class="px-4 row">
                    <div class="col-lg-8" style="font-weight: 500;">Total Harga ({{\Cart::getTotalQuantity()}} barang)</div>
                    <div class="col-lg-4"><span>Rp {{ number_format(\Cart::getSubTotal()) }}</span></div>
                </div>

                <div class="pt-10">
                    <hr />
                </div>

                <div class="px-4 row pt-2">
                    <h6 class="col-lg-8" style="font-weight: 600;">Total Harga</h6>
                    <div class="col-lg-4">Rp {{ number_format(\Cart::getTotal()) }}</div>
                </div>

                <div class="px-5 row pb-4">
                    <a style="color: white !important; font-size: 16px; font-weight: 500;" class=" mt-5 btn btn-light-green btn-block btn-lg" href="{{url('orders/checkout')}}">Beli ({{\Cart::getTotalQuantity()}})</a>
                </div>
            </div>
        </div>
        @else
        <div class="row pl-150 text-center ml-150">
            <div class="ml-5  col-lg-12">
                <img class="mx-auto" src="{{ asset('themes/sabilafresh/assets/img/front/empty-cart.svg') }}" alt="" width="230px">

                <p class="mb-0" style="font-weight:bold;">Wah keranjang belanjaanmu kosong!</p>
                <span class="text-center" style="font-size:11px;">Yuk, isi dengan buah-buah segar yang kami sediakan</span>
                <div class="mt-2">
                    <a style="color: white !important; font-size: 14px; font-weight: 500;" class="mx-10 btn btn-light-green btn-lg" href="{{url('/')}}">Mulai Belanja</a>
                </div>
            </div>

        </div>

        @endif
        {!! Form::close() !!}
    </div>
</div>
</div>
</div>
<!-- shopping-cart-area end -->
@endsection