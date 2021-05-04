@extends('admin.layout')

@section('content')

@php
$formTitle = !empty($category) ? 'Edit' : 'Tambah'
@endphp

<div class="section-header">
    <h1>Produk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-box-open"></i> Katalog</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/products')}}">Produk</a></div>

    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        @include('admin.products.product_menus')
    </div>

    <div class="col-lg-8">
        <div class="card card-default">
            <div class="card-body">
                @include('admin.partials.flash', ['$errors' => $errors])
                @if (!empty($product))
                {!! Form::model($product, ['url' => ['admin/products', $product->id], 'method' => 'PUT']) !!}
                {!! Form::hidden('id') !!}
                {!! Form::hidden('type') !!}
                @else
                {!! Form::open(['url' => 'admin/products']) !!}
                @endif

                <div class="form-group">
                    {!! Form::label('tipe', 'Tipe Produk') !!}
                    {!! Form::select('tipe', ['simple' => 'Tanpa Atribut'] , !empty($product) ? $product->type : null, ['class' => 'form-control product-type', 'disabled' => !empty($product)]) !!}
                    @error('tipe')
                    <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('sku', 'Kode Produk') !!}
                    {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => 'kode produk','autocomplete' => 'off']) !!}
                    @error('sku')
                    <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('nama', 'Nama Produk') !!}
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'nama','autocomplete' => 'off']) !!}
                    @error('nama')
                    <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('category_ids', 'Kategori') !!}
                    {!! General::selectMultiLevel('category_ids[]', $categories, ['class' => 'form-control form-control-sm ', 'multiple' => true, 'selected' => !empty(old('category_ids')) ? old('category_ids') : $categoryIDs]) !!}
                </div>

                <div class="configurable-attributes">
                    @if (!empty($configurableAttributes) && empty($product))
                    <p class="text-primary mt-4 font-weight-bold text-uppercase">Produk Atribut</p>
                    <hr />
                    @foreach ($configurableAttributes as $attribute)
                    <div class="form-group">
                        {!! Form::label($attribute->kode, $attribute->nama) !!}
                        {!! Form::select($attribute->kode. '[]', $attribute->AtributOpsis->pluck('nama','id'), null, ['class' => 'form-control form-control-sm', 'multiple' => true]) !!}
                    </div>
                    @endforeach
                    @endif
                </div>

                @if ($product)
                @if ($product->tipe == 'configurable')
                @include('admin.products.configurable')
                @else
                @include('admin.products.simple')
                @endif

                <div class="form-group">
                    {!! Form::label('deskripsi', 'Deskripsi') !!}
                    {!! Form::textarea('deskripsi', null, ['class' => 'form-control', 'placeholder' => 'Deskripsi']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('detail_deskripsi', 'Detail Deskripsi') !!}
                    {!! Form::textarea('detail_deskripsi', null, ['class' => 'form-control', 'placeholder' => 'detail deskripsi']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status', $statuses , null, ['class' => 'form-control', 'placeholder' => '-- Pilih --']) !!}
                    @error('status')
                    <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                @endif
                <div class="form-footer pt-5 border-top float-right">
                    <a href="{{ url('admin/products') }}" class="btn btn-secondary btn-default">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection