@extends('themes.sabilafresh.layout')

@section('content')
<!-- header end -->

<!-- checkout-area start -->
<div class="checkout-area ptb-100 mx-5">
	<div class="container">
		@include('admin.partials.flash', ['$errors' => $errors])

		{!! Form::model($user, ['url' => 'orders/checkout']) !!}
		<div class="row">
			<div class="col-lg-6 col-md-12 col-12 pt-30">
				<div class="checkbox-form">
					<h5 style="font-weight: 600;">Checkout</h5>
					<h6 class="pt-15 " style="font-weight: 600;">Alamat Pengiriman</h6>
					<hr />
					<div class="row">
						<div class="col-md-6 pt-2">
							<ul>
								<li class="text-capitalize text-dark" style="font-weight: 600;">{{ $user->nama_depan }} {{ $user->nama_belakang }}
									<div class="badge badge-success px-2 py-1"><span style="font-weight: 600;">Utama</span></div>
								</li>
								<li class="text-capitalize text-dark">
									@if(!empty($user->no_hp))
									{{ $user->no_hp }}
									@else
									<span class="text-success font-weight-light font-italic">silahkan isi no hp <a class="font-weight-bold" href="{{ url('profile') }}"> disini</a></span>
									@endif
								</li>
								<li class="text-capitalize text-dark">
									@if(!empty($user->alamat))
									{{ $user->alamat }}
									@else
									<span class="text-success font-weight-light font-italic">silahkan isi alamat <a class="font-weight-bold" href="{{ url('profile') }}"> disini</a></span>
									@endif
								</li>
								<li>
									@if(!empty($user->kode_pos))
									<span class="text-dark">{{ $user->kode_pos }}</span>
									@else
									<span class="text-success font-weight-light font-italic">silahkan isi kode pos <a class="font-weight-bold" href="{{ url('profile') }}"> disini</a></span>
									@endif
								</li>
							</ul>
						</div>

						<div class="col-md-6 mt-2">
							{!! Form::hidden('nama_depan', null, ['required' => true]) !!}
						</div>

						<div class="col-md-6 mt-2">
							{!! Form::hidden('nama_belakang', null, ['required' => true]) !!}
						</div>

						<div class="col-md-12 mt-2">
							{!! Form::hidden('alamat', null, ['required' => true, 'placeholder' => 'Home number and street name']) !!}
						</div>

						<div class="col-md-6 mt-2">
							{!! Form::hidden('kode_pos', null, ['required' => true, 'placeholder' => 'Postcode']) !!}
						</div>

						<div class="form-group row pl-15">
							<div class="col-md-5">
								<label class="text-dark">Provinsi<span class="required">*</span></label>
								{!! Form::select('provinsi_id', $provinces, Auth::user()->provinsi_id, ['id' => 'province-id', 'placeholder' => '- Pilih - ', 'required' => true]) !!}
							</div>
							<div class="col-md-6">
								<label class="text-dark">Kota<span class="required">*</span></label>
								{!! Form::select('kota_id', $cities, null, ['id' => 'city-id', 'placeholder' => '- Pilih -', 'required' => true])!!}
							</div>
						</div>


						<div class="col-md-6">
							<div class="checkout-form-list">
								{!! Form::hidden('no_hp', null, ['required' => true, 'placeholder' => 'Phone']) !!}
							</div>
						</div>
						<div class="col-md-6">
							<div class="checkout-form-list">
								{!! Form::hidden('email', null, ['placeholder' => 'Email', 'readonly' => true]) !!}
							</div>
						</div>
					</div>
					<div class="different-address">
						<div class="ship-different-title">
							<h3>
								<span class="pt-15 text-capitalize" style="font-weight: 500; font-size: 17px;">Pilih alamat pengiriman lain?</span>
								<input id="ship-box" type="checkbox" name="ship_to" />
							</h3>
						</div>
						<div id="ship-box-info">
							<div class="row">
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Nama Depan <span class="required">*</span></label>
										{!! Form::text('nama_depan_pengiriman',null, ['placeholder' => 'nama depan','autocomplete'=>'off']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Nama Belakang</label>
										{!! Form::text('nama_belakang_pengiriman',null, ['placeholder' => 'nama belakang','autocomplete'=>'off']) !!}
									</div>
								</div>

								<div class="col-md-12">
									<div class="order-notes">
										<label>Alamat <span class="required">*</span></label>
										{!! Form::textarea('alamat_pengiriman', null, ['placeholder' => 'nomor rumah , nomor jalan']) !!}
									</div>
								</div>

								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Provinsi<span class="required">*</span></label>
										{!! Form::select('provinsi_id_pengiriman', $provinces, null, ['id' => 'shipping-province', 'placeholder' => '- Pilih - ']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Kota<span class="required">*</span></label>
										{!! Form::select('kota_id_pengiriman', [], null, ['id' => 'shipping-city','placeholder' => '- Pilih -'])!!}
									</div>
								</div>

								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>Kode Pos <span class="required">*</span></label>
										{!! Form::text('kode_pos_pengiriman', null, ['placeholder' => 'kode pos','autocomplete'=>'off','id'=>'input-kodepos-order']) !!}
									</div>
								</div>
								<div class="col-md-6">
									<div class="checkout-form-list">
										<label>No Hp <span class="required">*</span></label>
										{!! Form::text('no_hp_pengiriman', null, ['placeholder' => 'no hp','autocomplete'=>'off','id'=>'input-hp-order']) !!}
									</div>
								</div>
								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Email </label>
										{!! Form::text('email_pengiriman', null, ['placeholder' => 'Email','autocomplete'=>'off']) !!}
									</div>
								</div>
							</div>
						</div>
						<div class="order-notes">
							<div class="checkout-form-list mrg-nn">
								<label>Catatan </label>
								{!! Form::textarea('catatan', null, ['cols' => 30, 'rows' => 10,'placeholder' => 'catatan pengiriman']) !!}
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-12">
				<div class="your-order">
					<h3>Ringkasan Belanja</h3>
					<div class="your-order-table table-responsive">
						<table>
							<thead>
								<tr>
									<th class="product-name">Produk</th>
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
									<th>Pajak</th>
									<td><span class="amount">{{ number_format(\Cart::getCondition('TAX 0%')->getCalculatedValue(\Cart::getSubTotal())) }}</span></td>
								</tr>
								<tr class="cart-subtotal">
									<th>Biaya pengiriman ({{ $totalWeight }} kg)</th>
									<td><select id="shipping-cost-option" required name="layanan_kurir"></select></td>
								</tr>
								<tr class="order-total">
									<th> Total</th>
									<td><strong><span class="total-amount">{{ number_format(\Cart::getTotal()) }}</span></strong>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					<div class="payment-method">
						<div class="payment-accordion">

							<div class="order-button-payment">
								<input type="submit" value="Lanjut" />
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

<script>
	function setInputFilter(textbox, inputFilter) {
		["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
			textbox.addEventListener(event, function() {
				if (inputFilter(this.value)) {
					this.oldValue = this.value;
					this.oldSelectionStart = this.selectionStart;
					this.oldSelectionEnd = this.selectionEnd;
				} else if (this.hasOwnProperty("oldValue")) {
					this.value = this.oldValue;
					this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
				} else {
					this.value = "";
				}
			});
		});
	}

	setInputFilter(document.getElementById("input-kodepos-order"), function(value) {
		return /^\d*$/.test(value);
	});
	setInputFilter(document.getElementById("input-hp-order"), function(value) {
		return /^\d*$/.test(value);
	});
</script>
@endsection