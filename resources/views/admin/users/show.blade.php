@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1 class="text-capitalize">{{ $user->nama_depan }} {{ $user->nama_belakang }}</h1>&nbsp;&nbsp;

    @if($user->is_admin == false)
    <span class="pt-2 badge btn-info"> {{ $user->kode }}</span>
    @endif
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
                    <div class="row mb-1">
                        <div class="col-md-12 d-flex flex-row-reverse ">
                            <span class=" border border-dark rounded p-1 font-weight-bold text-dark">Terdaftar: {{$user->created_at->format('d F Y')}}</span>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3 ">
                            <div class="d text-center py-2">
                                <img alt="image" src="{{ URL::asset('admin/assets/img/avatar/profile-1.png') }}" class="shadow rounded-circle" width="130px">
                            </div>
                        </div>

                        <div class="col-md-9 ">
                            <div class="row">
                                <div class="col-md-1 text-center"><span title="Nama" class="badge btn-info"><i class="fas fa-user"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    <h6 class="text-capitalize text-dark text-left">{{$user->nama_depan}} {{$user->nama_belakang}}</h6>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-1 text-center"><span title="Email" class="badge btn-warning"><i class="fas fa-envelope-open-text"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    <h6 class="text-dark text-left">{{$user->email}}</h6>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-1 text-center"><span title="Role" class="badge btn-primary"><i class="fas fa-tag"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    @if($user->is_admin == true)
                                    @if ($user->roles->contains('name', 'Admin'))
                                    <h6 class="text-dark text-left">{{ $user->roles->implode('name', ', ') }}</h6>
                                    @elseif ($user->roles->contains('name', 'Owner'))
                                    <h6 class="text-dark text-left">{{ $user->roles->implode('name', ', ') }}</h6>
                                    @endif
                                    @else
                                    <h6 class="text-dark text-left">Pelanggan</h6>
                                    @endif
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-1 text-center"><span title="no hp" class="badge btn-danger"><i class="fas fa-phone"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    <h6 class="text-dark text-left">{{$user->no_hp ? $user->no_hp : '-' }}</h6>
                                </div>
                            </div>

                            @if($user->is_admin == false)
                            <div class="row mt-2">
                                <div class="col-md-1 text-center"><span title="Jenis kelamin" class="badge btn-success"><i class="fas fa-venus-mars"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    <h6 class="text-dark text-left text-capitalize">{{$user->jk ? $user->jk : '-' }}</h6>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-1 text-center"><span title="Alamat" class="badge btn-dark"><i class="fas fa-home"></i></span></div>
                                <div class="col-md-11 pt-1 pl-1">
                                    <h6 class="text-dark text-left">
                                        @if(!empty($user->alamat && $user->kode_pos))
                                        {{$user->alamat}} , {{$user->kode_pos}}
                                        @else
                                        {{ '-' }}
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- list for customer only -->

@endsection