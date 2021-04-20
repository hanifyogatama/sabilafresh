@extends('themes.sabilafresh.auth_layout')

@section('content')

<!-- register-area start -->
<div class="container-fluid mt-4">
	<div class="row">
		<div class="col-lg-12 d-flex justify-content-center">
			<a href="/">
				<img src="{{ asset('themes/sabilafresh/assets/img/front/new-logo.svg') }}" alt="" width="155px">
			</a>
		</div>
	</div>
</div>

<div class="register-area ptb-50">
	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<div class="row mt-3 ml-5">
					<img class="mx-auto my-auto" src="{{ asset('themes/sabilafresh/assets/img/front/login.svg') }}" alt="" width="370px">
				</div>
				<div class="row mt-3 ml-5">
					<p class="mx-auto my-auto" style=" font-size: 1.3rem;">Beli Buah Murah dan Segar Hanya di Sabilafresh</p>
					<p class="mx-auto my-auto" style=" font-size: 0.8rem;">Daftar dan rasakan kemudahan bertransaksi di Sabilafresh</p>
				</div>
			</div>
			<div class="col">
				<div class="col-md-10 mr-auto">
					<div class="login">
						<div class="shadow login-form-container p-4 mx-4 bg-white rounded">
							<div class="login-form">
								<form method="POST" action="{{ route('register') }}">
									@csrf
									<div>
										<p class="text-center" style=" font-size: 1.5714285714285714rem;">Daftar Sekarang</p>
										<p class=" text-center">Sudah punya akun Sabilafresh? <a href="{{ url('login') }}" style="color: #03AC0E;">Masuk</a></p>

									</div>
							</div>

							<div class="row mx-1">
								<div class="col-md-12">
									<input id="nama_depan" type="text" class="form-control @error('nama_depan') is-invalid @enderror" autocomplete="off" name="nama_depan" value="{{ old('nama_depan') }}" required autofocus placeholder="Username">
									@error('nama_depan')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="row mx-1">
								<div class="col-md-12">
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" placeholder="Email">

									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="row mx-1">
								<div class="col-md-12">
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

									@error('password')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
							</div>

							<div class="row mx-1">
								<div class="col-md-12">
									<input id="txt" onkeyup="manage(this)" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
								</div>
							</div>

							<div class="form-group row mx-1 mt-3">
								<div class="col-md-12">
									<button type="submit" id="btSubmit" disabled class="btn btn-light-green btn-lg btn-block">Daftar</button>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<footer class="ptb-30">
	<div class="container">
		<div class="row">
			<div class="col-12 text-center">
				<div class="copyright-furniture">
					<p>Copyright © <a href="#">Sabilafresh</a> 2021</p>
				</div>
			</div>
		</div>
	</div>
</footer>

<!-- register-area end -->
@endsection