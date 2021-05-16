<div class="col-md-3">
    <div class="shadow product-wrapper mb-15 rounded-lg">
        <div class="product-img">
            <a href="{{ url('product/'. $product->slug) }}">
                @if($product->gambarProduk->first())
                <img src="{{ asset('storage/'.$product->gambarProduk->first()->gambar_medium) }}" alt="{{ $product->nama }}">
                @else
                <img src="{{ asset('themes/sabilafresh/assets/img/front/no_image.png') }}" alt="{{ $product->nama }}">
                @endif
            </a>

            <div class="product-action">
                <a class="animate-top add-to-fav" title="Favorite" product-slug="{{ $product->slug }}" href="">
                    <i class="pe-7s-like"></i>
                </a>
            </div>

            <div class="card-body pt-1 px-2">
                <div class="card-text">
                    <span style="color: rgba(49, 53, 59, 0.96) !important; text-transform: capitalize;" class="card-title"><a href="{{ url('product/'. $product->slug) }}">{{Str::limit($product->nama,33) }}</a></span>
                </div>


                <div class="badge badge-danger my-0 py-1 mt-2">
                    @foreach ($product->kategories->take(1) as $category)
                    <a style="color: white; font-weight: 500;" href=" {{ url('products/category/'. $category->slug ) }}">{{ $category->nama ? $category->nama : '-' }}</a></li>
                    @endforeach
                </div>

                <p class="card-text pt-1" style="font-weight:700; color: black; font-size: 14px !important;">Rp {{ number_format($product->price_label()) }}</p>
            </div>
        </div>
    </div>
</div>