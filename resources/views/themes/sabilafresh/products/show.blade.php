@extends('themes.sabilafresh.layout')

@section('content')
<div class="pt-120 ml-130 mr-130">
    <div class="container">
        <div class="ml-4 pl-1 breadcrumb-content">
            <ul>
                <li><a href="/">home</a></li>
                <li><a href="{{url('products')}}">produk</a> </li>
                <li style="color: #3e3e3e; font-size: 12px;">{{Str::limit($product->nama,20)}}</li>
            </ul>
        </div>
    </div>
</div>

<div class="product-details pt-20 ml-130 mr-130 ">
    <div class="container">
        <div class="row">
            <div class="col-md-4 fixed-column">
                <!-- gambar -->
                <div class="product-details-img-content">
                    <div class="product-details-tab mr-70">
                        <div class="product-details-large tab-content">
                            @php
                            $i = 1
                            @endphp
                            @forelse ($product->gambarProduk as $image)
                            <div class="tab-pane fade {{ ($i == 1) ? 'active show' : '' }}" id="pro-details{{ $i}}" role="tabpanel">
                                <div class="easyzoom easyzoom--overlay">
                                    @if ($image->gambar_medium && $image->gambar_xbesar)
                                    <a href="{{ asset('storage/'.$image->gambar_xbesar) }}">
                                        <img src="{{ asset('storage/'.$image->gambar_medium) }}" alt="{{ $product->nama }}" style="border-radius: 3%;">
                                    </a>
                                    @else
                                    <a href=" {{ asset('themes/sabilafresh/assets/img/product-details/bl1.jpg') }}">
                                        <img src="{{ asset('themes/sabilafresh/assets/img/product-details/l1.jpg') }}" alt="{{ $product->nama }}">
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @php
                            $i++
                            @endphp
                            @empty
                            No image found!
                            @endforelse
                        </div>

                        <div class="product-details-small nav mt-12 mb-5" role=tablist>
                            @php
                            $i = 1
                            @endphp
                            @forelse ($product->gambarProduk as $image)
                            <a class="{{ ($i == 1) ? 'active' : '' }} mr-12" href="#pro-details{{ $i }}" data-toggle="tab" role="tab" aria-selected="true">
                                @if ($image->gambar_medium)
                                <img src="{{ asset('storage/'.$image->gambar_medium) }}" alt="{{ $product->nama }}" style="border-radius: 16%; width:40px">
                                @else
                                <img src="{{ asset('themes/sabilafresh/assets/img/product-details/s1.jpg') }}" alt="{{ $product->nama }}">
                                @endif
                            </a>
                            @php
                            $i++
                            @endphp
                            @empty
                            No image found!
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-4 fixed-col">
                <!-- code in here -->
                <h6 class="text-capitalize" style="font-weight: 600;">{{ $product->nama }}</h6>
                <h4 class="mt-3" style="font-weight: 600;">Rp {{ number_format($product->price_label()) }}</h4>

                <div>
                    <hr class="mt-3" />
                </div>

                <div class="product-description-review-area ">
                    <div class="container">
                        <div class="product-description-review">
                            <div class="description-review-title nav mb-2 mt-2 ml-4" role=tablist>
                                <a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">
                                    Detail
                                </a>
                                <a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">
                                    Info Penting
                                </a>
                            </div>

                            <div style="margin-top: -9px; margin-left:-15px; width:111%;">
                                <hr />
                            </div>

                            <div class="description-review-text tab-content mt-4">
                                <div class="tab-pane active show fade" id="pro-dec" role="tabpanel">

                                    <div class="mt-3 mb-3">
                                        <ul>
                                            <li><span class="font-weight-light">Berat :</span> {{ number_format( $product->berat, 0, ',', '') }} Gram</li>
                                            <li><span class="font-weight-light">Kategori :</span>
                                                @foreach ($product->kategories as $category)
                                                <a style="color: #03AC0E; display: inline-block;  font-weight: 600;" href="{{ url('products?category/'. $category->slug ) }}">{{ $category->nama }}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                    <p class="mb-3">{{ $product->deskripsi }}</p>

                                    <p>
                                        {{ Str::limit($product->detail_deskripsi, 135,'') }}
                                        @if (strlen($product->detail_deskripsi) > 135)
                                        <span id="dots">...</span>
                                        <span id="more">{{ substr($product->detail_deskripsi,135) }}</span>

                                        <button style="background-color: transparent; border: 2px;color: #03AC0E; display: inline-block; font-size: 12px; font-weight:600; cursor: pointer; " onclick="myFunction()" id="myBtn">Lihat Selengkapnya</button>
                                        @endif
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="pro-review" role="tabpanel">
                                    <p class="text-capitalize mb-2" style="font-weight: 600;">Kebijakan Pengembalian Produk</p>

                                    <p> {{ Str::limit($product->detail_deskripsi, 135,'') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mt-2">
                    <hr />
                </div>
                <p class="text-capitalize m-0" style="font-weight: 600;">Pengiriman</p>
                <div class="mb-5"><i class="fas fa-map-marker-alt"></i> Kertodadi, Jln. Kaliurang KM.19, Sleman Yogyakarta</div>
            </div>

            <div class="col-md-4 fixed-column mb-5">
                <div class="shadow product-details-content rounded-lg p-2 ">
                    <h6 class="pl-2 pt-2" style="font-weight: 600;">Atur jumlah barang</h6>
                    {!! Form::open(['url' => 'carts']) !!}
                    {{ Form::hidden('produk_id', $product->id) }}
                    <!-- @if ($product->type == 'configurable')

                    <div class="quick-view-select">
                        <div class="select-option-part">
                            <label>Size*</label>
                            {!! Form::select('size', $sizes , null, ['class' => 'select', 'placeholder' => '- Please Select -', 'required' => true]) !!}
                        </div>
                        <div class="select-option-part">
                            <label>Color*</label>
                            {!! Form::select('color', $colors , null, ['class' => 'select', 'placeholder' => '- Please Select -', 'required' => true]) !!}
                        </div>
                    </div>
                    @endif -->


                    <div class="pl-2 quickview-plus-minus">
                        <div class="cart-plus-minus">
                            {!! Form::number('qty', 1, ['class' => 'cart-plus-minus-box', 'readonly','placeholder' => 'qty', 'min' => 1]) !!}
                        </div>
                    </div>

                    <div class="">
                        {{ $product->inventoriProduk->qty }}
                    </div>
                    <div class="row px-2 mt-4 mb-2">
                        <div class="col">
                            <a class="btn btn-outline-light-green bg-white btn-block add-to-fav" href="" product-slug="{{ $product->slug }}"><i class="fa fa-heart"></i> Wishlist</a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-light-green ">+ Keranjang</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection