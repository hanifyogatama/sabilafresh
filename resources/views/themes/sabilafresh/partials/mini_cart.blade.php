<div class="header-cart-4 mt-1 mr-10">
	<a class="icon-cart-furniture" href="{{ url('carts') }}">
		<i class="fa fa-shopping-cart"></i>

		@if(\Cart::getTotalQuantity())
		<span class="shop-count-furniture green">{{ \Cart::getTotalQuantity() }}</span>
		@elseif(!\Cart::getTotalQuantity())
		@endif
	</a>
	@if (!\Cart::isEmpty())
	<ul class="cart-dropdown">
		<div class="row cart-fixed">
			<div class="col mb-2 pt-3">
				<p style="font-weight: 600;">Keranjang ({{ \Cart::getTotalQuantity()}})</p>
			</div>
			<div class="col pt-3 pl-120"><a style="color: #03AC0E;" href="{{ url('carts') }}">Lihat Sekarang</a></div>
		</div>

		@foreach (\Cart::getContent() as $item)
		@php
		$product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
		$image = !empty($product->gambarProduk->first()) ? asset('storage/'.$product->gambarProduk->first()->path) : asset('themes/sabilafresh/assets/img/cart/3.jpg')
		@endphp
		<li class="single-product-cart ">
			<div class="cart-img">
				<a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}" style="width:50px; border-radius: 7%;"></a>
			</div>
			<div class="cart-title mt-0">
				<h5><a href="{{ url('product/'. $product->slug) }}">{{ Str::limit($item->name,27) }}</a></->
					<p style="font-size: 12px; font-weight: 500;">{{ $item->quantity }} Barang</p>

			</div>
			<div class="cart-delete pt-3">
				<!-- <a href="{{ url('carts/remove/'. $item->id)}}" class="delete"><i class="ti-trash"></i></a> -->
				<p style="font-size: 13px; color: orangered; font-weight: 600;">Rp {{ number_format($item->price) }}</p>
			</div>
		</li>
		@endforeach
		<!-- <li class="cart-space">
            <div class="cart-sub">
                <h4>Subtotal</h4>
            </div>
            <div class="cart-price">
                <h4>{{ number_format(\Cart::getSubTotal()) }}</h4>
            </div>
        </li>
        <li class="cart-btn-wrapper">
            <a class="cart-btn btn-hover" href="{{ url('orders/checkout') }}">checkout</a>
        </li> -->
	</ul>
	@elseif (\Cart::isEmpty())
	<ul class="cart-dropdown">
		<li class="cart-space">
			<div class="col" style="margin-top: -70px;">
				<div class="row mx-auto">
					<img class="mx-auto" src="{{ asset('themes/sabilafresh/assets/img/front/empty-cart.svg') }}" alt="" width="200px">
				</div>
				<div class="row">
					<p class="mx-auto" style="font-weight:bold;">Wah keranjang belanjaanmu kosong!</p>
					<span class="text-center" style="font-size:11px;">Daripada dianggurin, isi saja dengan barang-barang menarik. Lihat-lihat dulu, siapa tahu ada yang kamu suka!</span>
				</div>
			</div>
		</li>
	</ul>
	@endif
</div>