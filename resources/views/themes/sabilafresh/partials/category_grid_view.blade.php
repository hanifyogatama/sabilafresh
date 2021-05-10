@if ($categories)
@forelse ($categories as $category)
@include('themes.sabilafresh.partials.category_grid_box')
@empty
kategori produk tidak tersedia
@endforelse
@endif