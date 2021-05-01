@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Laporan Pelanggan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href=""><i class="fas fa-chart-bar"></i></i> Laporan</a> </div>
        <div class="breadcrumb-item"><a href="{{url('admin/reports/customer')}}">Pelanggan</a></div>
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-body">
                    @include('admin.partials.flash')

                    <div class="float-right">
                        {!! Form::open(['url'=> Request::path(),'method'=>'GET','class' => 'form-inline']) !!}
                        <div class="form-group mb-2">
                            {{ Form::select('export', $exports, !empty(request()->input('export')) ? request()->input('export') : null, ['placeholder' => '-- Export ke --', 'class' => 'form-control input-block']) }}
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <button type="submit" class="btn btn-primary btn-default">Export</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Hp</th>
                                <th>Alamat</th>
                                <th>Tgl Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->nama_depan }} {{ $customer->nama_belakang }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->no_hp }}</td>
                                <td>{{ Str::limit($customer->alamat, '30') }}</td>
                                <td>{{ date('d F Y', strtotime($customer->created_at)) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection