@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($category) ? 'Update' : 'Tambah'
@endphp

<div class="row">
    <div class="col-lg-6">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>{{$formTitle}} Kategori</h2>
            </div>
            <div class="card-body">
                <!-- @include('admin.partials.flash',['$errors' => $errors]) -->
                @if(!empty($Category))
                {!! Form::model($category, ['url' => ['admin/categories',$category->id], 'method'=>'PUT']) !!}
                {!! Form::hidden('id') !!}
                @else
                {!! Form::open(['url' => 'admin/categories']) !!}
                @endif
                <div class="form-group">
                    {!! Form::label('nama','Nama Kategori') !!}
                    {!! Form::text('nama',null,['class' => 'form-control' ,'placeholder' => 'nama kategori','autocomplete' => 'off']) !!}
                    @error('nama')
                    <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-footer pt-5 border-top">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection