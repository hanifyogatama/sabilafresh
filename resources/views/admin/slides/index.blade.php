@extends('admin.layout')

@section('content')

<div class="section-header">
    <h1>Slide Gambar</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-cogs"></i> Setting</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/slides')}}">Slide gambar</a></div>
        <!-- <div class="breadcrumb-item">Table</div> -->
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    @include('admin.partials.flash')

                    @can('add_slides')
                    <div class="row">
                        <div class="col">
                            <a href="{{url('admin/slides/create')}}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i></a>
                        </div>
                    </div>
                    @endcan

                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse ($slides as $key => $slide)
                            <tr>
                                <th>{{ $slides->firstItem() + $key }}</th>
                                <td><img src="{{ asset('storage/'. $slide->gambar_kecil) }}" style="width: 90px; border-radius: 6px;" /></td>

                                @if($slide->status == 'Aktif')
                                <td>
                                    <div class="badge btn-info">
                                        {{ $slide->status }}
                                    </div>
                                </td>
                                @else
                                <td>
                                    <div class="badge btn-secondary">
                                        {{ $slide->status }}
                                    </div>
                                </td>
                                @endif

                                <td>
                                    @can('edit_slides')
                                    <a href="{{ url('admin/slides/'. $slide->id .'/edit') }}" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit"><i class="far fa-edit"></i></a>
                                    @endcan

                                    @can('delete_slides')
                                    {!! Form::open(['url' => 'admin/slides/'. $slide->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::button(' <i class="far fa-trash-alt"></i> ',['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'data-toggle'=>'tooltip','title'=>'Hapus']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">Data tidak tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $slides->links() }}
                </div>



            </div>
        </div>
    </div>
</div>
@endsection