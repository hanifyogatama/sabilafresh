@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($category) ? 'Edit' : 'Tambah'
@endphp

<div class="section-header">
    <h1>{{$formTitle}} Kategori</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-box-open"></i> Katalog</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/categories')}}">Kategori</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
    </div>
</div>


<div class="row">
    <div class="col-lg-6">
        <div class="card card-default">
            <div class="card-body">
                <!-- @include('admin.partials.flash',['$errors' => $errors]) -->
                @if(!empty($category))
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
                <div class="form-group">
                    {!! Form::label('parent_id', 'Parent') !!}
                    {!! General::selectMultiLevel('parent_id', $categories, ['class' => 'form-control', 'selected' => !empty(old('parent_id')) ? old('parent_id') : (!empty($category['parent_id']) ? $category['parent_id'] : ''), 'placeholder' => '-- Choose Category --']) !!}
                </div>
                <div class="form-footer pt-5 border-top float-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection