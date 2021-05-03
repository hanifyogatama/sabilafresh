@extends('themes.sabilafresh.layout')

@section('content')
@include('themes.sabilafresh.partials.slider')
@include('themes.sabilafresh.partials.category_products')


@include('themes.sabilafresh.partials.popular_products')

<div class="pl-2 mx-4 pr-2 ">
    <hr />
</div>

@include('themes.sabilafresh.partials.products')

<div class="row">
    <div class="col" style="height: 10px; background-color: #E5E7E9;"></div>
</div>
@include('themes.sabilafresh.partials.advertise')

@endsection