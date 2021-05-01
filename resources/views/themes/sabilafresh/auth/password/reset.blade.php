@extends('themes.sabilafresh.auth_layout')

@section('content')

<!-- register-area start -->

<div class="mx-auto mt-5" style="background-image: url('{{ asset('themes/sabilafresh/assets/img/front/.svg') }}');  height: 450px; background-repeat: no-repeat; background-position: center; ">

    <div class="container-fluid mt-0">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <a href="">
                    <img src="{{ asset('themes/sabilafresh/assets/img/front/new-logo.svg') }}" alt="" width="155px">
                </a>
            </div>
        </div>
    </div>

    <div class="register-area ptb-40">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-4 mr-auto ml-auto">
                    <div class="login">
                        <div class="shadow login-form-container p-4 mx-0 bg-white rounded">
                            <div class="login-form">
                                <div>
                                    <p class="text-left font-weight-bold" style=" font-size: 1rem;">Reset Kata Sandi</p>
                                </div>

                                @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                                @endif

                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" readonly value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        
                                            <input id="password-confirm" onkeyup="manage(this)" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Ulangi Password') }}">
                                        
                                    </div>
                                    <div class="form-group row mb-2">
                                        <div class="col-md-12">
                                            <div class="button-box">
                                                <button type="submit" id="btSubmit" disabled class="btn btn-light-green btn-lg btn-block">{{ __('Reset Password') }}</button>
                                            </div>
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
<!-- register-area end -->
@endsection