@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($category) ? 'Edit' : 'Tambah'
@endphp

<div class="section-header">
    <h1>{{$formTitle}} Produk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Katalog</a></div>
        <div class="breadcrumb-item"><a href="{{url('admin/products')}}">Produk</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
    </div>
</div>



<div class="row">
    <div class="col-lg-6">
        <div class="card card-default">
            <div class="card-body">
                @include('admin.partials.flash', ['$errors' => $errors])
                @if (!empty($product))
                {!! Form::model($product, ['url' => ['admin/products', $product->id], 'method' => 'PUT']) !!}
                {!! Form::hidden('id') !!}
                @else
                {!! Form::open(['url' => 'admin/products']) !!}
                @endif
                <a href="{{ url('admin/products') }}" class="btn btn-warning btn-m"><i class="fas fa-chevron-left "></i></a>
                <hr />
                <div class="form-group">
                    {!! Form::label('sku', 'SKU') !!}
                    {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'sku','autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('nama', 'Nama') !!}
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'nama','autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('harga', 'Harga') !!}
                    {!! Form::text('harga', null, ['class' => 'form-control', 'placeholder' => 'harga','autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('category_ids', 'Kategori') !!}
                    {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control', 'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs, 'placeholder' => '-- Pilih --']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('deskripsi', 'Deskripsi') !!}
                    {!! Form::textarea('deskripsi', null, ['class' => 'form-control', 'placeholder' => 'Deskripsi']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('detail_deskripsi', 'Detail Deskripsi') !!}
                    {!! Form::textarea('detail_deskripsi', null, ['class' => 'form-control', 'placeholder' => 'detail deskripsi']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('berat', 'Berat') !!}
                    {!! Form::text('berat', null, ['class' => 'form-control', 'placeholder' => 'berat','autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('panjang', 'Panjang') !!}
                    {!! Form::text('panjang', null, ['class' => 'form-control', 'placeholder' => 'panjang','autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('lebar', 'Lebar') !!}
                    {!! Form::text('lebar', null, ['class' => 'form-control', 'placeholder' => 'lebar','autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('tinggi', 'Tinggi') !!}
                    {!! Form::text('tinggi', null, ['class' => 'form-control', 'placeholder' => 'tinggi','autocomplete' => 'off']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Pilih --']) !!}
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