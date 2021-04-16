@extends('admin.layout')

@section('title', 'Role & Permission')

@section('content')
<!-- Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
    <div class="modal-dialog" role="document">
        {!! Form::open(['method' => 'post']) !!}

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="roleModalLabel">Role</h4>
            </div>
            <div class="modal-body">
                <!-- name Form Input -->
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                <!-- Submit Form Button -->
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<div class="section-header">
    <h1>Role</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">User & Role</a></div>
        <div class="breadcrumb-item"><a href="{{url('admin/roles')}}">Role</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body mt-3">
                    @include('admin.partials.flash')
                    <div id="accordion-role-permission" class="accordion accordion-bordered ">
                        @forelse ($roles as $role)
                        {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id ], 'class' => 'm-b']) !!}

                        @if($role->name === 'Admin')
                        @include('admin.roles._permissions', ['title' => $role->name .' Permissions', 'options' => ['disabled'], 'showButton' => true])
                        @else
                        @include('admin.roles._permissions', ['title' => $role->name .' Permissions', 'model' => $role, 'showButton' => true])
                        @endif

                        {!! Form::close() !!}

                        @empty
                        <p>tidak ada data silahkan jalankan <code>php artisan db:seed</code> untuk mendapatkan data dummy.</p>
                        @endforelse
                    </div>
                </div>
                @can('add_roles')
                <div class="card-footer text-right">
                    <a href="#" class="btn btn-success pull-right" data-toggle="modal" data-target="#roleModal"> <i class="glyphicon glyphicon-plus"></i> New Role</a>
                </div>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection