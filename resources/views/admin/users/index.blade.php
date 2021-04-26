@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1>User</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-users"></i></i> User & Role</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/users')}}">User</a></div>

    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.partials.flash')

                    @can('add_users')
                    <div class="row">
                        <div class="col">
                            <a href="{{ url('admin/users/create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    @endcan

                    <table class="table ">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Terdaftar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp

                            @forelse ($userAdmins as $userAdmin)
                            @if ($userAdmin->is_admin == 1)
                            <tr>

                                <th scope="row">{{$no}}</th>
                                <td class="text-capitalize">{{Str::limit($userAdmin->nama_depan, '15') }}</td>



                                <td>{{Str::limit($userAdmin->email, '23') }}</td>

                                <td>

                                    @if ($userAdmin->roles->contains('name', 'Admin'))
                                    <span class="badge badge-primary">{{ $userAdmin->roles->implode('name', ', ') }}</span>
                                    @elseif ($userAdmin->roles->contains('name', 'Owner'))
                                    <span class="badge badge-info">{{ $userAdmin->roles->implode('name', ', ') }}</span>
                                    @else
                                    <span class="badge badge-success">Pelanggan</span>
                                    @endif

                                </td>

                                <td>{{ $userAdmin->created_at->format('d-F-Y') }}</td>


                                <td>
                                    @if($userAdmin->isOnline())
                                    <label class="py-2 px-3 badge btn-success">Online</label>
                                    @else
                                    <label class="py-2 px-3 badge btn-danger">Offline</label>
                                    @endif
                                </td>
                                <td>

                                    @role('Owner')
                                    <span class="badge badge-danger"><i class="fas fa-exclamation-triangle"></i> Admin</span>
                                    @endrole

                                    @can('add_users')
                                    <a href="{{ url('admin/users/'. $userAdmin->id .'/edit') }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a>
                                    @endcan

                                    @if (!$userAdmin->hasRole('Admin'))
                                    @can('add_users')
                                    {!! Form::open(['url' => 'admin/users/'. $userAdmin->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button('<i class="far fa-trash-alt"></i> ', ['type' => 'submit','class' => 'btn btn-danger btn-sm', 'data-toggle'=>'tooltip','title'=>'Hapus']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    @endif
                                </td>
                            </tr>
                            @php $no++; @endphp
                            @endif
                            @empty
                            <tr>
                                <td colspan="6">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- list for customer only -->

<div class="section-body">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table ">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Terdaftar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($userCustomers as $key => $userCustomer)
                            @if ($userCustomer->is_admin == 0)
                            <tr>

                                <th scope="row">{{ $userCustomers->firstItem() + $key }}</th>
                                <td class="text-capitalize">{{Str::limit($userCustomer->nama_depan, '7') }}</td>



                                <td>{{Str::limit($userCustomer->email, '23') }}</td>

                                <td>

                                    @if ($userCustomer->roles->contains('name', 'Admin'))
                                    <span class="badge badge-primary">{{ $userCustomer->roles->implode('name', ', ') }}</span>
                                    @elseif ($userCustomer->roles->contains('name', 'Owner'))
                                    <span class="badge badge-info">{{ $userCustomer->roles->implode('name', ', ') }}</span>
                                    @else
                                    <span class="badge badge-success">Pelanggan</span>
                                    @endif
                                </td>
                                <td>{{ $userCustomer->created_at->format('d-F-Y') }}</td>
                                <td>
                                    @if($userCustomer->isOnline())
                                    <label class="py-2 px-3 badge btn-success">Online</label>
                                    @else
                                    <label class="py-2 px-3 badge btn-danger">Offline</label>
                                    @endif
                                </td>
                                <td>

                                    @role('Owner')
                                    <span class="badge badge-danger"><i class="fas fa-exclamation-triangle"></i> Admin</span>
                                    @endrole

                                    @can('add_users')
                                    <a href="{{ url('admin/users/'. $userCustomer->id .'/edit') }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a>
                                    @endcan

                                    @if (!$userCustomer->hasRole('Admin'))
                                    @can('add_users')
                                    {!! Form::open(['url' => 'admin/users/'. $userCustomer->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button('<i class="far fa-trash-alt"></i> ', ['type' => 'submit','class' => 'btn btn-danger btn-sm', 'data-toggle'=>'tooltip','title'=>'Hapus']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    @endif
                                </td>
                            </tr>
                            @endif
                            @empty
                            <tr>
                                <td colspan="6">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $userCustomers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection