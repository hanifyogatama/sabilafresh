@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Kategori</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-box-open"></i> Katalog</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/categories')}}">Kategori</a></div>
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
                    <div class="row">
                        <div class="col">
                            <a href="{{url('admin/categories/create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i></a>
                        </div>
                        <div class="col"></div>
                    </div>

                    <div class="col d-inline-flex p-0 mb-2">
                        @include('admin.partials.search')
                        <a href="{{url('admin/categories')}}" data-toggle="tooltip" title="Refresh" class="btn btn-sm btn-success btn-default px-2"><i class="fas fa-sync-alt"></i></a>
                    </div>

                    <table class="table  mt-2">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Parent</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $key => $category)
                            <tr>
                                <th scope="row">{{ $categories->firstItem() + $key }}</th>
                                <td>{{$category->nama}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{ $category->parent ? $category->parent->nama : '-' }}</td>

                                <td>
                                    <a href="{{ url('admin/categories/'.$category->id.'/edit') }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a>

                                    {!! Form::open(['url' => 'admin/categories/'.$category->id,'class' => 'delete','style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button(' <i class="far fa-trash-alt"></i> ',['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'data-toggle'=>'tooltip','title'=>'Hapus']) !!}
                                    {!! form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    <span class="text-dark">Data tidak tersedia</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection