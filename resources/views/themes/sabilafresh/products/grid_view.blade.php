<div class="row">
    @forelse ($products as $product)
    @include('themes.sabilafresh.products.grid_box')
    @empty
    <div class="col">
        <div class="row mx-auto">
            <img class="mx-auto" src="{{ asset('themes/sabilafresh/assets/img/front/empty-box.svg') }}" alt="" width="250px">
        </div>
        <div class="row mt-2">
            <p class="mx-auto" style="font-weight: 400;">Produk kosong atau tidak ditemukan</p>
        </div>
    </div>
    @endforelse
</div>