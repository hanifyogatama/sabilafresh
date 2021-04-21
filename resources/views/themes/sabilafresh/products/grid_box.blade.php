<div class="col-md-6 col-xl-4">
    <div class="shadow product-wrapper mb-30 rounded-lg">
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
                <!-- <a class="animate-top add-to-card" title="Add To Cart" href="" product-id="{{ $product->id }}" product-type="{{ $product->type }}" product-slug="{{ $product->slug }}">
                    <i class="pe-7s-cart"></i>
                </a> -->
                <!-- <a class="animate-right quick-view" title="Quick View" product-slug="{{ $product->slug }}" href="">
                    <i class="pe-7s-look"></i>
                </a> -->
            </div>
        </div>


        <div class="card-body">
            <span class="badge badge-danger">
                @foreach ($product->kategories->take(1) as $category)
                <li><a style="color: white;" href=" {{ url('products/category/'. $category->slug ) }}">{{ $category->nama }}</a></li>
                @endforeach
            </span>

            <h5 class="card-title"><a href="{{ url('product/'. $product->slug) }}">{{ $product->nama }}</a></h5>
            <p class="card-text" style="font-weight: bold;">Rp {{ number_format($product->price_label()) }}</p>

        </div>

    </div>
</div>