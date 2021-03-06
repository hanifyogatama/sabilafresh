@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Produk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-box-open"></i> Katalog</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/products')}}">Produk</a></div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('admin.partials.flash')
                    @can('add_products')
                    <div class="row">
                        <div class="col">
                            <a href="{{url('admin/products/create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i></a>
                        </div>
                        <div class="col"></div>
                    </div>
                    @endcan

                    <div class="col d-inline-flex p-0 mb-2">
                        @include('admin.partials.search')
                        <a href="{{url('admin/products')}}" data-toggle="tooltip" title="Refresh" class="btn btn-sm btn-success btn-default px-2"><i class="fas fa-sync-alt"></i></a>
                    </div>

                    <table class="table  mt-2">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $key => $product)
                            <tr>
                                <th scope="row">{{ $products->firstItem() + $key }}</th>
                                <td style="width: 20%;">{{ Str::limit($product->sku,14)}}</td>

                                <td style="width: 26%;">{{ Str::limit($product->nama,21) }}</td>
                                <td>Rp {{ number_format($product->harga) }}</td>

                                @if($product->status_label() == 'aktif')
                                <td>
                                    <div class="badge btn-info text-capitalize">
                                        {{ $product->status_label() }}
                                    </div>
                                </td>
                                @else
                                <td>
                                    <div class="badge btn-secondary text-capitalize ">
                                        {{ $product->status_label() }}
                                    </div>
                                </td>
                                @endif

                                <td style="width: 15%;">
                                    <a href="{{ url('admin/products/'.$product->id.'/edit') }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a>
                                    @can('delete_products')
                                    {!! Form::open(['url' => 'admin/products/'.$product->id,'class' => 'delete','style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button(' <i class="far fa-trash-alt"></i> ',['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'data-toggle'=>'tooltip','title'=>'Hapus']) !!}
                                    {!! form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center;">
                                    <span>Data Tidak Tersedia</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection