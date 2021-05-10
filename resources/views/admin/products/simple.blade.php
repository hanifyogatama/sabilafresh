<div class="row">

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('harga', 'Harga') !!}
            {!! Form::number('harga', null, ['class' => 'form-control', 'placeholder' => 'harga', 'min' => '1','autocomplete'=>'off']) !!}
            @error('harga')
            <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('berat', 'Berat') !!}<span><small class="text-danger"> (satuan gram min:1000 gr)</small></span>
            {!! Form::number('berat', null, ['class' => 'form-control', 'placeholder' => 'berat cth. 1000','min' => '1000','autocomplete'=>'off']) !!}
            @error('harga')
            <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('qty', 'Qty') !!}
            {!! Form::number('qty', null, ['class' => 'form-control', 'placeholder' => 'qty','min' => '1','autocomplete'=>'off']) !!}
            @error('qty')
            <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('panjang', 'Panjang') !!}<span><small class="text-danger"> (opsional)</small></span>
            {!! Form::number('panjang', null, ['class' => 'form-control', 'placeholder' => 'panjang','min' => '1','autocomplete'=>'off']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('lebar', 'Lebar') !!}<span><small class="text-danger"> (opsional)</small></span>
            {!! Form::number('lebar', null, ['class' => 'form-control', 'placeholder' => 'lebar','min' => '1','autocomplete'=>'off']) !!}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {!! Form::label('tinggi', 'Tinggi') !!}<span><small class="text-danger"> (opsional)</small></span>
            {!! Form::number('tinggi', null, ['class' => 'form-control', 'placeholder' => 'tinggi','min' => '1','autocomplete'=>'off']) !!}
        </div>
    </div>
</div>