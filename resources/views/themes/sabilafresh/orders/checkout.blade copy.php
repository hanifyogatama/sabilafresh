@extends('themes.sabilafresh.layout')

@section('content')
<!-- header end -->


<!-- checkout-area start -->
<div class="checkout-area ptb-100 mx-5">
	<div class="container">
		{!! Form::model($user, ['url' => 'orders/checkout']) !!}
		<div class="row">
			<div class="col-lg-6 col-md-12 col-12 pt-30">
				<div class="checkbox-form">
					<h5 style="font-weight: 600;">Checkout</h5>
					<h6 class="pt-15 " style="font-weight: 600;">Alamat Pengirim</h6>
					<hr />
					<div class="row">
						<div class="col-md-6 pt-2">
							<ul>
								<li class="text-capitalize" style="font-weight: 600;">{{ $user->nama_depan }} {{ $user->nama_belakang }}
									<div class="badge badge-success px-2 py-1"><small style="font-weight: 600;">Utama</small></div>
								</li>
								<li>{{ $user->no_hp }}</li>
								<li class="text-capitalize">{{ $user->alamat }}</li>
								<li>{{ $user->email }}</li>
								<li></li>
							</ul>
						</div>

						<div class="col-md-12 pt-20">
							<div class="checkout-form-list">
								<label>Provinsi<span class="required">*</span></label>
								{!! Form::select('provinsi_id', $provinces, Auth::user()->province_id, ['id' => 'province-id', 'placeholder' => '- Pilih - ', 'required' => true]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="checkout-form-list">
								<label>Kota<span class="required">*</span></label>
								{!! Form::select('kota_id', $cities, null, ['id' => 'city-id', 'placeholder' => '- Pilih -', 'required' => true])!!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="checkout-form-list">
								<label>Kode Pos<span class="required">*</span></label>
								{!! Form::number('kode_pos', null, ['required' => true, 'placeholder' => 'Kode pos']) !!}
							</div>
						</div>
						<!-- <div class="col-md-6">
							<div class="checkout-form-list">
								<label>No Hp<span class="required">*</span></label>
								{!! Form::text('no_hp', null, ['required' => true, 'placeholder' => 'No hp']) !!}
							</div>
						</div> -->
						<!-- <div class="col-md-6">
							<div class="checkout-form-list">
								<label>Email</label>
								{!! Form::text('email', null, ['placeholder' => 'Email', 'disabled' => true]) !!}
							</div>
						</div> -->
					</div>
					<hr />

					<div class="different-address">
						<div class="ship-different-title">
							<div class="pt-10">
								<label style="font-weight: 600;">Kirim ke alamat lain?</label>
								<input id="ship-box" type="checkbox" />
							</div>
						</div>
						<div id="ship-box-info">
							<div class="row">
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Nama Depan <span class="required">*</span></label>
										{!! Form::text('nama_depan_pengiriman') !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Nama Belakang <span class="required">*</span></label>
										{!! Form::text('nama_belakang_pengiriman') !!}
									</div>
								</div>
								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Alamat <span class="required">*</span></label>
										{!! Form::textarea('alamat_pengiriman', null, ['placeholder' => 'Home number and street name']) !!}
									</div>
								</div>
								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Provinsi<span class="required">*</span></label>
										{!! Form::select('provinsi_id_pengiriman', $provinces, null, ['id' => 'shipping-province', 'placeholder' => '- Pilih - ']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Kota <span class="required">*</span></label>
										{!! Form::select('kota_id_pengiriman', [], null, ['id' => 'shipping-city','placeholder' => '- Pilih -'])!!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Kode Pos <span class="required">*</span></label>
										{!! Form::number('kode_pos_pengiriman', null, ['placeholder' => 'Postcode']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>No Hp <span class="required">*</span></label>
										{!! Form::text('no_hp_pengiriman', null, ['placeholder' => 'Phone']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Email </label>
										{!! Form::text('email_pengiriman', null, ['placeholder' => 'Email']) !!}
									</div>
								</div>
							</div>
						</div>
						<hr />
						<div class="order-notes">
							<div class="checkout-form-list mrg-nn">
								<label>Catatan</label>
								{!! Form::textarea('catatan', null, ['cols' => 30, 'rows' => 10,'placeholder' => 'Catatan pengiriman']) !!}
							</div>
						</div>
					</div>
				</div>

				<hr />
				<!-- carousel -->
				<div class="panel-group mt-3" id="faq">

					<div class="panel panel-default">
						<div class="panel-heading">
							<h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-2">Cheque Payment</a></h5>
						</div>
						<div id="payment-2" class="panel-collapse collapse">
							<div class="panel-body">
								<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
							</div>
						</div>
					</div>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5 class="panel-title"><a class="collapsed" data-toggle="collapse" aria-expanded="false" data-parent="#faq" href="#payment-3">PayPal</a></h5>
						</div>
						<div id="payment-3" class="panel-collapse collapse">
							<div class="panel-body">
								<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
							</div>
						</div>
					</div>
				</div>
				<!-- end carousel -->
			</div>




			<div class="col-lg-6 col-md-12 col-12 pt-90">
				<div class="your-order">
					<h3>Your order</h3>
					<div class="your-order-table table-responsive">
						<table>
							<thead>
								<tr>
									<th class="product-name">Product</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($items as $item)
								@php
								$product = isset($item->associatedModel->parent) ? $item->associatedModel->parent : $item->associatedModel;
								$image = !empty($product->gambarProduk->first()) ? asset('storage/'.$product->gambarProduk->first()->path) : asset('themes/sabilafresh/assets/img/cart/3.jpg')
								@endphp
								<tr class="cart_item">
									<td class="product-name">
										{{ $item->name }} <strong class="product-quantity"> × {{ $item->quantity }}</strong>
									</td>
									<td class="product-total">
										<span class="amount">{{ number_format(\Cart::get($item->id)->getPriceSum()) }}</span>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="2">The cart is empty! </td>
								</tr>
								@endforelse
							</tbody>
							<tfoot>
								<tr class="cart-subtotal">
									<th>Subtotal</th>
									<td><span class="amount">{{ number_format(\Cart::getSubTotal()) }}</span></td>
								</tr>
								<tr class="cart-subtotal">
									<th>Pajak</th>
									<td><span class="amount">{{ number_format(\Cart::getCondition('TAX 0%')->getCalculatedValue(\Cart::getSubTotal())) }}</span></td>
								</tr>
								<tr class="cart-subtotal">
									<th>Biaya Pengiriman ({{ $totalWeight }} kg)</th>
									<td><select id="shipping-cost-option" required></select></td>
								</tr>
								<tr class="order-total">
									<th>total Tagihan</th>
									<td><strong><span class="total-amount">{{ number_format(\Cart::getTotal()) }}</span></strong>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="payment-method">
						<div class="payment-accordion">
							<div class="order-button-payment">
								<input type="submit" value="Place order" />
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
<!-- checkout-area end -->
@endsection