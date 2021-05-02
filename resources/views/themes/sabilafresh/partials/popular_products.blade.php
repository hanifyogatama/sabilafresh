<!-- product area start -->
<div class="popular-product-area  pt-115 pb-115">
    <div class="row px-5">
       
        <div class="product-style">
            <div class="popular-product-active-2 owl-carousel">
                @forelse ($products->take(5) as $product)
                    <div class="shadow product-wrapper mb-15 rounded-lg ml-2 mr-5">
                        <div class="product-img">
                            <a href="{{ url('product/'. $product->slug) }}">
                                @if ($product->gambarProduk->first())
                                <img src="{{ asset('storage/'.$product->gambarProduk->first()->gambar_medium) }}" alt="{{ $product->nama }}">
                                @else
                                <img src="{{ asset('themes/sabilafarm/assets/img/product/fashion-colorful/1.jpg') }}" alt="{{ $product->nama }}">
                                @endif
                            </a>

                            <div class="product-action">
                                <a class="animate-top add-to-fav" title="Favorite" product-slug="{{ $product->slug }}" href="">
                                    <i class="pe-7s-like"></i>
                                </a>
                            </div>

                            <div class="card-body pt-1 px-2">
                                <div class="card-text">
                                    <span style="color: rgba(49, 53, 59, 0.96) !important; text-transform: capitalize;" class="card-title"><a href="{{ url('product/'. $product->slug) }}">{{Str::limit($product->nama,43) }}</a></span>
                                </div>


                                <div class="badge badge-danger my-0 py-1 mt-2">
                                    @foreach ($product->kategories->take(1) as $category)
                                    <a style="color: white; font-weight: 500;" href=" {{ url('products/category/'. $category->slug ) }}">{{ $category->nama }}</a></li>
                                    @endforeach
                                </div>

                                <p class="card-text pt-1" style="font-weight:700; color: black; font-size: 14px !important;">Rp {{ number_format($product->price_label()) }}</p>

                            </div>
                        </div>
                    </div>
               
                @empty
                <!-- <div class="col">
                    <div class="row mx-auto">
                        <img class="mx-auto" src="{{ asset('themes/sabilafresh/assets/img/front/empty-box.svg') }}" alt="" width="250px">
                    </div>
                    <div class="row mt-2">
                        <p class="mx-auto" style="font-weight: 400;">Produk kosong atau tidak ditemukan</p>
                    </div>
                </div> -->
                @endforelse

            </div>
        </div>
    </div>
</div>
<!-- product area end -->