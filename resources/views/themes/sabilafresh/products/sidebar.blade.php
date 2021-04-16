<div class="shop-sidebar mr-50">

    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">Filter by Price</h3>
        <div class="price_filter">
            <div id="slider-range"></div>
            <div class="price_slider_amount">
                <div class="label-input">
                    <label>price : </label>
                    <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                </div>
                <button type="button">Filter</button>
            </div>
        </div>
    </div>

    @if ($categories)
    <div class="sidebar-widget mb-45">
        <h3 class="sidebar-title">Kategori</h3>
        <div class="sidebar-categories">
            <ul>
                @foreach ($categories as $category)
                <li><a href="{{ url('products?category='. $category->slug) }}">{{ $category->nama }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="sidebar-widget sidebar-overflow mb-45">
        <h3 class="sidebar-title">color</h3>
        <div class="product-color">
            <ul>
                <li class="red">b</li>
                <li class="pink">p</li>
                <li class="blue">b</li>
                <li class="sky">b</li>
                <li class="green">y</li>
                <li class="purple">g</li>
            </ul>
        </div>
    </div>
    <div class="sidebar-widget mb-40">
        <h3 class="sidebar-title">size</h3>
        <div class="product-size">
            <ul>
                <li><a href="#">xl</a></li>
                <li><a href="#">m</a></li>
                <li><a href="#">l</a></li>
                <li><a href="#">ml</a></li>
                <li><a href="#">lm</a></li>
            </ul>
        </div>
    </div>


</div>