@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($slide) ? 'Edit' : 'Tambah'
@endphp

<div class="section-header">
    <h1>{{$formTitle}} Slide Gambar</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-cogs"></i> Setting</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/categories')}}">Kategori</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
    </div>
</div>


<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">

                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    @if (!empty($slide))
                    {!! Form::model($slide, ['url' => ['admin/slides', $slide->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
                    {!! Form::hidden('id') !!}
                    @else
                    {!! Form::open(['url' => 'admin/slides', 'enctype' => 'multipart/form-data']) !!}
                    @endif

                    @if (empty($slide))
                    <div class="form-group">
                        {!! Form::label('image', 'Gambar (ukuran : xxx)') !!}
                        {!! Form::file('image', ['class' => 'form-control-file', 'placeholder' => 'product image']) !!}
                    </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('status', 'Status') !!}
                        {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Pilih --']) !!}
                    </div>
                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Simpan</button>
                        <a href="{{ url('admin/slides') }}" class="btn btn-secondary btn-default">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection