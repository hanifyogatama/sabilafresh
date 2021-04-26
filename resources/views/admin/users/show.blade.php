@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1>{{ $user->nama_depan }} {{ $user->nama_belakang }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-user"></i></i> User profile</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/users/'. \Auth::user()->id)}}">{{ $user->nama_depan }}</a></div>
    </div>
</div>


<div class="content">
    <div class="row">
        <div class="col-lg">
            <div class="card card-default">
                <div class="card-body">
                    {!! Form::model($user, ['route' => ['users.show', $user->id ] ]) !!}
                    <div class="row">
                        <div class="col-md-3 ">
                            <div class="d text-center py-2">
                                <img alt="image" src="{{ URL::asset('admin/assets/img/avatar/profile-1.png') }}" class="shadow rounded-circle" width="130px">
                            </div>
                        </div>
                        <div class="col-md-9 ">
                            <div class="row">
                                <div class="col-md-1 text-center"><span class="badge btn-info"><i class="fas fa-user"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    <h6 class="text-dark text-left">{{$user->nama_depan}} {{$user->nama_belakang}}</h6>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-1 text-center"><span class="badge btn-warning"><i class="fas fa-envelope-open-text"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    <h6 class="text-dark text-left">{{$user->email}}</h6>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-1 text-center"><span class="badge btn-primary"><i class="fas fa-tag"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    @role('Admin')
                                    <h6 class="text-dark text-left">Admin</h6>
                                    @endrole
                                    @role('Owner')
                                    <h6 class="text-dark text-left">Owner</h6>
                                    @endrole
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-1 text-center"><span class="badge btn-dark"><i class="fas fa-clock"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    <h6 class="text-dark text-left">Terdaftar : {{$user->created_at->format('d F Y')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- list for customer only -->

@endsection