
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

    <a href="https://api.whatsapp.com/send?phone=6289676310705&text=Saya%20tertarik%20untuk%20membeli%20produk%20ini%20segera." class="float-whatsapp" target="_blank">
        <i class="fab fa-whatsapp my-float-whatsapp"></i>
    </a>

    @endsection

