@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1>Atribut</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Katalog</a></div>
        <div class="breadcrumb-item"><a href="{{url('admin/attributes')}}">Atribut Produk</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-5">
            @include('admin.attributes.option_form')
        </div>
        <div class="col-lg-7">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h5>Isi Atribut : {{ $attribute->nama }}</h5>
                </div>
                <div class="card-body">
                    <table class="table ">
                        <thead>
                            <th style="width:10%">No</th>
                            <th>Name</th>
                            <th style="width:30%">Action</th>
                        </thead>
                        <tbody>
                            @forelse ($attribute->atributOpsis as $option)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $option->nama }}</td>
                                <td>
                                    <a href="{{ url('admin/attributes/options/'. $option->id .'/edit') }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit" ><i class="far fa-edit"></i></a>
                                    {!! Form::open(['url' => 'admin/attributes/options/'. $option->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button(' <i class="far fa-trash-alt"></i> ',['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'data-toggle'=>'tooltip','title'=>'Hapus']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr style="text-align:center">
                                <td colspan="3">Data Tidak Tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection