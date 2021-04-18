<div class="row">
    @forelse ($products as $product)
    @include('themes.sabilafresh.products.grid_box')
    @empty
    No product found!
    @endforelse
</div>