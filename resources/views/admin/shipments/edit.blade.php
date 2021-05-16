@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Proses Pengiriman</h1>
    <div class="section-header-breadcrumb">
    </div>
</div>

<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    <div class="row border rounded px-3 py-3 mx-0 mt-3">
                        <div class="col-md-12 p-0 ">
                            <p class="text-dark mb-2" style="font-weight: bold; font-size:16px; text-transform: capitalize;">Detail Pengiriman</p>
                            <address>
                                <div class="row pt-2">
                                    <div class="col-sm-5">Nama</div>
                                    <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $shipment->nama_depan }} {{ $shipment->nama_belakang}}</div>
                                </div>

                                <div class="row pt-2">
                                    <div class="col-sm-5">Email</div>
                                    <div class="col-sm-7 text-left text-dark"> {{ $shipment->email }}</div>
                                </div>

                                <div class="row pt-2">
                                    <div class="col-sm-5">No Hp</div>
                                    <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $shipment->no_hp }}</div>
                                </div>

                                <div class="row pt-2">
                                    <div class="col-sm-5">Alamat</div>
                                    <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $shipment->alamat}} , {{ $shipment->kodepos}}</div>
                                </div>

                                <div class="row pt-2">
                                    <div class="col-sm-5">Kurir</div>
                                    <div class="col-sm-7 text-left text-dark text-capitalize">{{ $shipment->pemesanan->nama_kurir }} ({{ $shipment->pemesanan->layanan_kurir }})</div>
                                </div>

                                <div class="row pt-2">
                                    <div class="col-sm-5">Status Pengiriman</div>
                                    <div class="col-sm-7 text-left text-dark text-capitalize">{{ $shipment->status }}</div>
                                </div>

                            </address>
                        </div>
                    </div>

                    <table class="table mt-3 table-striped table-responsive-large" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Banyak</th>
                                <th>Berat Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($shipment->pemesanan->ItemPemesanan as $item)
                            <tr>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->berat+0 }} gr</td>
                                <td>Rp {{ \General::priceFormat($item->harga) }}</td>
                                <td>Rp {{ \General::priceFormat($item->sub_total) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Order item not found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row justify-content-end">
                        <div class="col-lg-5 col-xl-6 col-xl-3 ml-sm-auto">
                            <ul class="list-unstyled mt-4">
                                <li class="mid pb-3 text-dark">Subtotal
                                    <span class="d-inline-block float-right text-default">Rp {{ \General::priceFormat($shipment->pemesanan->total_awal) }}</span>
                                </li>
                                <li class="mid pb-3 text-dark">Pajak({{$shipment->pemesanan->persen_pajak+0}}%)
                                    <span class="d-inline-block float-right text-default">Rp {{ \General::priceFormat($shipment->pemesanan->jumlah_pajak) }}</span>
                                </li>
                                <li class="mid pb-3 text-dark">Biaya Pengiriman ({{$shipment->total_berat}} gr)
                                    <span class="d-inline-block float-right text-default">Rp {{ \General::priceFormat($shipment->pemesanan->biaya_pengiriman) }}</span>
                                </li>
                                <li class="pb-3 text-dark">Total
                                    <span class="d-inline-block float-right">Rp {{ \General::priceFormat($shipment->pemesanan->total_akhir) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {!! Form::model($shipment, ['url' => ['admin/shipments', $shipment->id], 'method' => 'PUT']) !!}
                    {!! Form::hidden('id') !!}

                    <div class="form-group" style="width: 500px;">
                        {!! Form::label('no_resi','Nomor Resi')!!}
                        {!! Form::text('no_resi', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group row" style="display: none;">
                        <div class="col-md-6">
                            {!! Form::hidden('nama_depan', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::hidden('nama_belakang', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                    </div>

                    <div class="form-group" style="display: none;">
                        {!! Form::hidden('alamat', null, ['class' => 'form-control', 'readonly' => true]) !!}
                    </div>

                    <div class="form-group" style="display: none;">
                        {!! Form::select('provinsi_id', $provinces, $shipment->provinsi_id, ['id' => 'province-id', 'class' => 'form-control', 'disabled' => true]) !!}
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6" style="display: none;">

                            {!! Form::select('kota_id', $cities, $shipment->city_id, ['id' => 'city-id', 'class' => 'form-control', 'disabled' => true])!!}
                        </div>
                        <div class="col-md-6" style="display: none;">
                            {!! Form::hidden('kodepos', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;">
                        <div class="col-md-6">
                            {!! Form::hidden('no_hp', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-6" style="display: none;">
                            {!! Form::hidden('email', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row" style="display: none;">
                        <div class="col-md-6">
                            {!! Form::hidden('total_qty', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-6" style="display: none;">
                            {!! Form::hidden('total_berat', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ url('admin/orders/'. $shipment->pemesanan->id) }}" class="btn btn-secondary btn-default">Back</a>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection