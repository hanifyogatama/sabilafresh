@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Kategori</h1>
    <div class="section-header-breadcrumb">
        <!-- <div class="breadcrumb-item active"><a href="#">Kategori</a></div>
        <div class="breadcrumb-item"><a href="#">Bootstrap Components</a></div>
        <div class="breadcrumb-item">Table</div> -->
    </div>
</div>

<div class="section-body">

    <div class="row">
        <div class="col-12 col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Kategori</h4>
                </div>
                <div class="card-body">
                    <a href="{{url('admin/categories/create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i></a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Parent</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$category->nama}}</td>
                                <td>{{$category->slug}}</td>
                                <td>{{$category->parent_id}}</td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    <span class="text-dark">data tidak tersedia</span>
                                </td>
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