@extends('admin.layout')

@section('title', 'Create')

@section('content')

<div class="section-header">
    <h1>User</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-users"></i></i> User & Role</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/users')}}">Tambah User</a></div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-8">
            <div class="card card-default">

                <div class="card-body">
                    {!! Form::open(['route' => ['users.store'] ]) !!}

                    <input type="hidden" name="is_admin" class="form-control" value="1" />
                    @include('admin.users.form')
                    <div class="form-group @if ($errors->has('roles')) has-error @endif">
                        {!! Form::label('roles[]', 'Roles') !!}
                        {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null, ['class' => 'form-control form-control-sm', 'multiple']) !!}
                        @error('roles')
                        <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <!-- Submit Form Button -->
                    <div class="form-footer pt-5 border-top float-right">
                        <a href="{{ url('admin/users') }}" class="btn btn-secondary btn-default">Kembali</a>
                        {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection