@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Produk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Katalog</a></div>
        <div class="breadcrumb-item"><a href="{{url('admin/products')}}">Produk</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- <div class="card-header">
                    <h4>Kategori</h4>
                </div> -->
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

                    <!-- <div class="card-header-form">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div> -->

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
                                <td style="width: 20%;">{{ Str::limit($product->sku,16)}}</td>

                                <td style="width: 32%;">{{ Str::limit($product->nama,32) }}</td>
                                <td>Rp {{ number_format($product->harga) }}</td>

                                @if($product->status_label() == 'active')
                                <td>
                                    <div class="badge badge-info">
                                        {{ $product->status_label() }}
                                    </div>
                                </td>
                                @elseif($product->status_label() == 'draft')
                                <td>
                                    <div class="badge badge-success">
                                        {{ $product->status_label() }}
                                    </div>
                                </td>
                                @else
                                <td>
                                    <div class="badge badge-danger">
                                        {{ $product->status_label() }}
                                    </div>
                                </td>
                                @endif

                                <td>
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