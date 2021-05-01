@extends('themes.sabilafresh.layout')

@section('content')
<!-- header end -->
<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url({{ asset('themes/sabilafresh/assets/img/bg/breadcrumb.jpg') }})">
	<div class="container">
		<div class="breadcrumb-content text-center">
			<h2>Checkout Page</h2>
			<ul>
				<li><a href="{{ url('/') }}">home</a></li>
				<li> Checkout Page</li>
			</ul>
		</div>
	</div>
</div>
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
	<div class="container">
		@include('admin.partials.flash', ['$errors' => $errors])

		{!! Form::model($user, ['url' => 'orders/checkout']) !!}
		<div class="row">
			<div class="col-lg-6 col-md-12 col-12">
				<div class="checkbox-form">
					<h3>Billing Details</h3>
					<div class="row">
						<div class="col-md-6">
							<div class="checkout-form-list">
								<label>First Name <span class="required">*</span></label>
								{!! Form::text('nama_depan', null, ['required' => true]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="checkout-form-list">
								<label>Last Name <span class="required">*</span></label>
								{!! Form::text('nama_belakang', null, ['required' => true]) !!}
							</div>
						</div>

						<div class="col-md-12">
							<div class="checkout-form-list">
								<label>Address <span class="required">*</span></label>
								{!! Form::text('alamat', null, ['required' => true, 'placeholder' => 'Home number and street name']) !!}
							</div>
						</div>

						<div class="col-md-12">
							<div class="checkout-form-list">
								<label>Province<span class="required">*</span></label>
								{!! Form::select('provinsi_id', $provinces, Auth::user()->provinsi_id, ['id' => 'province-id', 'placeholder' => '- Pilih - ', 'required' => true]) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="checkout-form-list">
								<label>City<span class="required">*</span></label>
								{!! Form::select('kota_id', $cities, null, ['id' => 'city-id', 'placeholder' => '- Pilih -', 'required' => true])!!}

							</div>
						</div>

						<div class="col-md-6">
							<div class="checkout-form-list">
								<label>Postcode / Zip <span class="required">*</span></label>
								{!! Form::number('kode_pos', null, ['required' => true, 'placeholder' => 'Postcode']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="checkout-form-list">
								<label>Phone <span class="required">*</span></label>
								{!! Form::text('no_hp', null, ['required' => true, 'placeholder' => 'Phone']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="checkout-form-list">
								<label>Email Address </label>
								{!! Form::text('email', null, ['placeholder' => 'Email', 'readonly' => true]) !!}
							</div>
						</div>
					</div>
					<div class="different-address">
						<div class="ship-different-title">
							<h3>
								<label>Ship to a different address?</label>
								<input id="ship-box" type="checkbox" name="ship_to" />
							</h3>
						</div>
						<div id="ship-box-info">
							<div class="row">
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>First Name <span class="required">*</span></label>
										{!! Form::text('nama_depan_pengiriman') !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Last Name <span class="required">*</span></label>
										{!! Form::text('nama_belakang_pengiriman') !!}
									</div>
								</div>

								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Address <span class="required">*</span></label>
										{!! Form::text('alamat_pengiriman', null, ['placeholder' => 'Home number and street name']) !!}
									</div>
								</div>

								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Province<span class="required">*</span></label>
										{!! Form::select('provinsi_id_pengiriman', $provinces, null, ['id' => 'shipping-province', 'placeholder' => '- Please Select - ']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>City<span class="required">*</span></label>
										{!! Form::select('kota_id_pengiriman', [], null, ['id' => 'shipping-city','placeholder' => '- Please Select -'])!!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Postcode / Zip <span class="required">*</span></label>
										{!! Form::number('kodepos_pengiriman', null, ['placeholder' => 'Postcode']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Phone <span class="required">*</span></label>
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
						<div class="order-notes">
							<div class="checkout-form-list mrg-nn">
								<label>Order Notes</label>
								{!! Form::textarea('catatan', null, ['cols' => 30, 'rows' => 10,'placeholder' => 'Notes about your order, e.g. special notes for delivery.']) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-12">
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
								$image = !empty($product->gambarProduk->first()) ? asset('storage/'.$product->gambarProduk->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg')
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
									<th>Tax</th>
									<td><span class="amount">{{ number_format(\Cart::getCondition('TAX 0%')->getCalculatedValue(\Cart::getSubTotal())) }}</span></td>
								</tr>
								<tr class="cart-subtotal">
									<th>Shipping Cost ({{ $totalWeight }} kg)</th>
									<td><select id="shipping-cost-option" required name="layanan_kurir"></select></td>
								</tr>
								<tr class="order-total">
									<th>Order Total</th>
									<td><strong><span class="total-amount">{{ number_format(\Cart::getTotal()) }}</span></strong>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="payment-method">
						<div class="payment-accordion">
							<div class="panel-group" id="faq">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h5 class="panel-title"><a data-toggle="collapse" aria-expanded="true" data-parent="#faq" href="#payment-1">Direct Bank Transfer.</a></h5>
									</div>
									<div id="payment-1" class="panel-collapse collapse show">
										<div class="panel-body">
											<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
										</div>
									</div>
								</div>
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