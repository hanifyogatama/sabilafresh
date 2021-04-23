<div class="row">
    @forelse ($favorites as $favorite)
    @php
    $product = $favorite->produk;
    $product = isset($product->parent) ?: $product;
    $image = !empty($product->gambarProduk->first()) ? asset('storage/'.$product->gambarProduk->first()->gambar_medium) : asset('themes/sabilafresh/assets/img/cart/3.jpg')
    @endphp
    @include('themes.sabilafresh.favorites.grid_box')
    @empty
    <div class="col">
        <div class="row mx-auto">
            <img class="mx-auto" src="{{ asset('themes/sabilafresh/assets/img/front/empty.svg') }}" alt="" width="270px">
        </div>
        <div class="row">
            <p class="mx-auto">Anda belum menambahkan wishlist.<a href="/" style="color: #03AC0E;"> Mulai mencari produk</a></p>
        </div>
    </div>
    @endforelse
</div>