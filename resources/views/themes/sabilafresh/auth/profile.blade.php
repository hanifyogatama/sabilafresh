@extends('themes.sabilafresh.layout')

@section('content')

<div class="shop-page-wrapper shop-page-padding ptb-150">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                @include('themes.sabilafresh.partials.user_menu')
            </div>
            <div class="col-lg-9">
                <div class="d-flex justify-content-between mb-2">
                    <h5 class="row ml-1" style="font-weight: 500; color: #6C727C;"><i class="fa fa-user" style="font-size:22px ; color: #6C727C; margin-right: 10px;"></i>Biodata Diri</h5>
                </div>
                @include('admin.partials.flash')
                <div class="login">
                    <div class="shadow login-form-container bg-white rounded-lg">
                        <div class="login-form">
                            {!! Form::model($user, ['url' => ['profile']]) !!}
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6">
                                    {!! Form::text('nama_depan', null, ['class' => 'form-control', 'placeholder' => 'nama depan', 'required' => true]) !!}
                                    @error('nama_depan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {!! Form::text('nama_belakang', null, ['class' => 'form-control', 'placeholder' => 'nama belakang', 'required' => true]) !!}
                                    @error('nama_belakang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    {!! Form::textarea('alamat', null, ['required' => true, 'placeholder' => 'Rumah, Apartemen, Kontrakan, Kosan','style' => 'height: 100px;']) !!}
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <!-- <div class="form-group row">
                                <div class="col-md-6">
                                    {!! Form::select('provinsi_id', $provinces, Auth::user()->province_id, ['id' => 'user-province-id', 'placeholder' => '- Pilih - ', 'required' => true]) !!}
                                    @error('province_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {!! Form::select('kota_id', $cities, null, ['id' => 'user-city-id', 'placeholder' => '- Pilih -', 'required' => true])!!}
                                    @error('city_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <div class="col-md-6">
                                    {!! Form::text('kode_pos', null, ['required' => true, 'placeholder' => 'Kode pos','id'=>'num-input-kodepos']) !!}
                                    @error('kode_pos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    {!! Form::text('no_hp', null, ['required' => true, 'placeholder' => 'No hp','id'=>'num-input-hp']) !!}
                                    @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email', 'required' => true]) !!}
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Form::select('jk', ['pria'=>'Pria','wanita'=>'Wanita'], null, ['class' => 'form-control', 'placeholder' => '-- Jenis Kelamin --']) !!}
                                @error('jk')
                                <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="button-box">
                                <button type="submit" class="btn btn-light-green float-right">Simpan</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- register-area end -->



@endsection