<div class="div mb-2">
    <div class="row ml-2">
        <h6 style="font-weight: 600;">Filter</h6>
    </div>
</div>

<div class="shadow sidebar-widget mb-45 p-4 mx-2 bg-white rounded-lg ">
    <div class="shop-sidebar ">
        <form method="GET" action="{{ url('products')}}">
            <div class="sidebar-widget mb-40">
                <p class="row ml-1" style="font-weight: 500;">Harga</p>
                <div class="price_filter">
                    <div id="slider-range"></div>
                    <div class="price_slider_amount">
                        <div class="label-input ">
                            <input type="text" id="amount" name="harga" placeholder="Add Your Price" style="width:170px" readonly/>
                            <input type="hidden" id="productMinPrice" value="{{ $minPrice }}" />
                            <input type="hidden" id="productMaxPrice" value="{{ $maxPrice }}" />
                        </div>
                        <button type="submit">Filter</button>
                    </div>
                </div>
            </div>
        </form>
        <hr />
        @if ($categories)
        <div class="sidebar-widget mb-35">
            <p class="row ml-1" style="font-weight: 500; margin-bottom: 0px;">Kategori</p>

            @foreach ($categories as $category)
            <p class="ml-2" style="margin-bottom: 1px; margin-top: 2px;"><a class="list-category" href="{{ url('products?category='. $category->slug) }}">{{ $category->nama }}</a></p>
            @endforeach

        </div>
        @endif

    </div>
</div>