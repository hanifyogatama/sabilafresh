@extends('themes.sabilafresh.auth_layout')

@section('content')

<!-- register-area start -->
<div class="mx-auto mt-5" style="background-image: url('{{ asset('themes/sabilafresh/assets/img/front/form-form.svg') }}');  height: 450px; background-repeat: no-repeat; background-position: center; ">

    <div class="container-fluid mt-0">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <a href="/">
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
                        <div class="shadow login-form-container p-4 mx-3 bg-white rounded">
                            <div class="login-form">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="row mb-4 mt-4">
                                        <div class="col">
                                            <p class="text-left" style=" font-size: 1.2rem;">Masuk</p>
                                        </div>
                                        <div class="col">
                                            <p class="text-right"><a href="{{ url('register') }}" style="color: #03AC0E;">Daftar</a></p>
                                        </div>
                                    </div>
                                    <div class=" row">
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-mail') }}">
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="txt" onkeyup="manage(this)" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0 mt-5">
                                        <div class="col-md-12">
                                            <div class="button-box">
                                                <div class="login-toggle-btn">
                                                    <a href="{{ route('password.request') }}" style="color: #03AC0E;">{{ __('Lupa kata sandi?') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-3 mb-4">
                                        <div class="col-md-12">
                                            <button type="submit" id="btSubmit" disabled class="btn btn-light-green btn-lg btn-block">Masuk</button>
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


    <footer class="pt-50 pb-20">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="copyright-furniture">
                        <p>Copyright © <a href="#">Sabilafresh</a> 2021</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>

<!-- register-area end -->
@endsection