@extends('admin.layout')

@section('title', 'Edit User ' . $user->nama_depan)

@section('content')
<div class="section-header">
    <h1>Edit User</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-users"></i></i> User & Role</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/users')}}">User</a></div>

    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h5><span class="badge badge-primary">{{ $user->nama_depan }}</span> </h5>
                </div>
                <div class="card-body">
                    {!! Form::model($user, ['method' => 'PUT', 'route' => ['users.update', $user->id ] ]) !!}
                    @include('admin.users.form')
                    <!-- Submit Form Button -->
                    @if($user->is_admin == true)
                    <div class="form-group @if ($errors->has('roles')) has-error @endif">
                        {!! Form::label('roles[]', 'Roles') !!}
                        {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null, ['class' => 'form-control form-control-sm', 'multiple']) !!}
                        @error('roles')
                        <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    @endif
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