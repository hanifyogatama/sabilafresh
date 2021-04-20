@extends('themes.sabilafresh.auth_layout')

@section('content')
<!-- register-area start -->
<div class="register-area ptb-20">
	<p class="text-left ml-3"><a href="{{ url('login') }}" style="color: #03AC0E;"><i class="fa fa-arrow-left fa-2x"></i></a></p>
	<div class="container-fluid">
		<div>
			<p class="text-center" style=" font-size: 1.7rem;">Atur ulang kata sandi</p>
			<p class=" text-center">Masukkan e-mail yang terdaftar. Kami akan mengirimkan link <br />untuk atur ulang kata sandi anda.</p>

		</div>
		<div class="row mb-2">
			<img class="mx-auto my-auto" src="{{ asset('themes/sabilafresh/assets/img/front/forget-password.svg') }}" alt="" width="230px">
		</div>
		<div class="row">
			<div class="col-lg-5 ml-auto mr-auto mt-4">
				<div class="login">
					<div class="login">
						<div class="login-form">
							@if (session('status'))
							<div class="alert alert-success" role="alert">
								{{ session('status') }}
							</div>
							@endif

							<form method="POST" action="{{ route('password.email') }}">
								@csrf

								<div class="form-group row">
									<div class="col-md-12">
										<input id="txt" onkeyup="manage(this)" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus placeholder="{{ __('alamat email') }}">

										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="form-group row ">
									<div class="col-md-12">
										<button type="submit" id="btSubmit" disabled class="btn btn-light-green btn-sm btn-block">{{ __('Kirim') }}</button>
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
<!-- register-area end -->
@endsection