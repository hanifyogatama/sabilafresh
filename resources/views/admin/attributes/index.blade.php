@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Atribut Produk</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Katalog</a></div>
        <div class="breadcrumb-item"><a href="{{url('admin/attributes')}}">Atribut Produk</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-9">
            <div class="card">
                <!-- <div class="card-header">
                    <h4>Kategori</h4>
                </div> -->
                <div class="card-body">

                    @include('admin.partials.flash')
                    <div class="row">
                        <div class="col">
                            <a href="{{url('admin/attributes/create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i></a>
                        </div>
                        <div class="col"></div>
                    </div>

                    <table class="table  mt-2">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Kode</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Tipe</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attributes as $key => $attribute)
                            <tr>
                                <th scope="row">{{ $attributes->firstItem() + $key }}</th>
                                <td>{{ $attribute->kode }}</td>
                                <td style="width:23%">{{ $attribute->nama }}</td>
                                <td>{{ $attribute->tipe }}</td>

                                <td>
                                    <a href="{{ url('admin/attributes/'. $attribute->id .'/edit') }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit">
                                        <i class="far fa-edit"></i></a>
                                    @if ($attribute->tipe == 'select')

                                    <a href="{{ url('admin/attributes/'. $attribute->id .'/options') }}" class="btn btn-success btn-sm">Options</a>
                                    @endif

                                    {!! Form::open(['url' => 'admin/attributes/'. $attribute->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button(' <i class="far fa-trash-alt"></i> ',['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'data-toggle'=>'tooltip','title'=>'Hapus']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    <span class="text-dark">Data Kosong</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <hr />
                    {{ $attributes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection