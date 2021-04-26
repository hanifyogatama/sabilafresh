@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1>Produk Gambar</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-box-open"></i> Katalog</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/products')}}">Produk</a></div>
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
                    @include('admin.partials.flash')
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Action</th>
                        </thead>
                        <tbody>

                            @forelse ($productImages as $image)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td><img src="{{ asset('storage/'.$image->gambar_medium) }}" style="width: 54px; border-radius: 6px;" /></td>
                                <td>
                                    {!! Form::open(['url' => 'admin/products/images/'. $image->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button(' <i class="far fa-trash-alt"></i> ',['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'data-toggle'=>'tooltip','title'=>'Hapus']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr style="text-align: center;">
                                <td colspan="3">Data Tidak Tesedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ url('admin/products') }}" class="btn btn-secondary btn-default">Kembali</a>
                    <a href="{{ url('admin/products/'.$productID.'/add-image') }}" class="btn btn-primary">Tambah</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection