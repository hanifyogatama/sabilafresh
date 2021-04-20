@if ($categories)
@forelse ($categories as $category)
@include('themes.sabilafresh.partials.category_grid_box')
@empty
No product found!
@endforelse
@endif