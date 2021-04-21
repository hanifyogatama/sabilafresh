@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1>User</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">User & Role</a></div>
        <div class="breadcrumb-item"><a href="{{url('admin/users')}}">User</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
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
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($users as $key => $user)
                            <tr>
                                <th scope="row">{{ $users->firstItem() + $key }}</th>
                                <td>{{Str::limit($user->nama_depan, '15') }}</td>
                                <td>{{Str::limit($user->email, '23') }}</td>
                                <td>

                                    @if ($user->roles->contains('name', 'Admin'))
                                    <span class="badge badge-primary">{{ $user->roles->implode('name', ', ') }}</span>
                                    @elseif ($user->roles->contains('name', 'Owner'))
                                    <span class="badge badge-info">{{ $user->roles->implode('name', ', ') }}</span>
                                    @else
                                    <span class="badge badge-success">Pelanggan</span>
                                    @endif

                                </td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                <td>

                                    @role('Owner')
                                    <span class="badge badge-danger"><i class="fas fa-exclamation-triangle"></i> Admin</span>
                                    @endrole

                                    @can('add_users')
                                    <a href="{{ url('admin/users/'. $user->id .'/edit') }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a>
                                    @endcan

                                    @if (!$user->hasRole('Admin'))
                                    @can('add_users')
                                    {!! Form::open(['url' => 'admin/users/'. $user->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button('<i class="far fa-trash-alt"></i> ', ['type' => 'submit','class' => 'btn btn-danger btn-sm', 'data-toggle'=>'tooltip','title'=>'Hapus']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection