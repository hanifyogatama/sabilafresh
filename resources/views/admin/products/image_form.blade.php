@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1>Upload Produk Gambar</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-box-open"></i> Katalog</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/products')}}">Produk</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-4">
            @include('admin.products.product_menus')
        </div>
        <div class="col-lg-8">
            <div class="card card-default">

                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    {!! Form::open(['url' => ['admin/products/images', $product->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        {!! Form::label('image', 'Product Image') !!}
                        {!! Form::file('image', ['class' => 'form-control-file', 'placeholder' => 'product image']) !!}
                    </div>
                    <div class="form-footer pt-5 border-top ">
                        <a href="{{ url('admin/products/'.$productID.'/images') }}" class="btn btn-secondary btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary btn-default">Simpan</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection