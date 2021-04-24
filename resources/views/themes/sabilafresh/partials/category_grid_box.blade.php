<div class="ml-30 mr-30 mt-20 mb-30">
    <div class="card-block ">
        <div class="mx-auto" style="background-image: url('{{ asset('themes/sabilafresh/assets/img/front/leaf.svg') }}');  height: 40px; background-repeat: no-repeat; background-position: start; ">
            <p class="card-title pl-5 pt-3"><a class="list-category text-capitalize" href="{{ url('products?category='. $category->slug) }}">{{ $category->nama }}</a></p>
        </div>
    </div>
</div>