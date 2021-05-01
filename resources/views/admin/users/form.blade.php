
<!-- email Form Input -->
<div class="form-group @if ($errors->has('email')) has-error @endif">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email','autocomplete'=>'off']) !!}
    @error('email')
    <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- password Form Input -->
<div class="form-group @if ($errors->has('password')) has-error @endif">
    {!! Form::label('password', 'Password') !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
    @error('password')
    <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
    @enderror
</div>

<!-- Roles Form Input -->


