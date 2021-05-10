@extends('admin.layout')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $shipment->pemesanan->kode }}</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    {!! Form::model($shipment, ['url' => ['admin/shipments', $shipment->id], 'method' => 'PUT']) !!}
                    {!! Form::hidden('id') !!}
                    <div class="form-group row">
                        <div class="col-md-6">
                            {!! Form::label('nama_depan', 'Nama Depan') !!}
                            {!! Form::text('nama_depan', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('nama_belakang', 'Nama Belakang') !!}
                            {!! Form::text('nama_belakang', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('alamat', 'Alamat ') !!}
                        {!! Form::text('alamat', null, ['class' => 'form-control', 'readonly' => true]) !!}
                    </div>

                    <div class="form-group" style="display: none;">
                        {!! Form::select('provinsi_id', $provinces, $shipment->provinsi_id, ['id' => 'province-id', 'class' => 'form-control', 'disabled' => true]) !!}
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6" style="display: none;">
                           
                            {!! Form::select('kota_id', $cities, $shipment->city_id, ['id' => 'city-id', 'class' => 'form-control', 'disabled' => true])!!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('kodepos', 'Kode pos') !!}
                            {!! Form::text('kodepos', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6" >
                            {!! Form::label('no_hp', 'No Hp') !!}
                            {!! Form::text('no_hp', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            {!! Form::label('total_qty', 'Jumlah Banyak') !!}
                            {!! Form::text('total_qty', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('total_berat', 'Total Berat (gram)') !!}
                            {!! Form::text('total_berat', null, ['class' => 'form-control', 'readonly' => true]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('no_resi', 'Nomor Resi') !!}
                        {!! Form::text('no_resi', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Save</button>
                        <a href="{{ url('admin/orders/'. $shipment->pemesanan->id) }}" class="btn btn-secondary btn-default">Back</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Pengiriman</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Detail Pengiriman</p>
                            <address>
                                {{ $shipment->pemesanan->nama_depan_konsumen }} {{ $shipment->pemesanan->nama_belakang_konsumen }}
                                <br> {{ $shipment->pemesanan->alamat_konsumen }}
                                <br> {{ $shipment->pemesanan->email_konsumen }}
                                <br> {{ $shipment->pemesanan->no_hp_konsumen }}
                                <br> {{ $shipment->pemesanan->kodepos_konsumen }}
                            </address>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;"></p>
                            <address>
                                <span class="text-dark">{{ $shipment->pemesanan->kode }}</span>
                                <br> {{ \General::datetimeFormat($shipment->pemesanan->order_date) }}
                                <br> Status: {{ $shipment->pemesanan->status }}
                                <br> Status Pembayaran: {{ $shipment->pemesanan->status_pembayaran }}
                                <br> {{ $shipment->pemesanan->layanan_kurir }}
                            </address>
                        </div>
                    </div>
                    <table class="table mt-3 table-striped table-responsive table-responsive-large" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($shipment->pemesanan->ItemPemesanan as $item)
                            <tr>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ \General::priceFormat($item->sub_total) }}</td>
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
                                    <span class="d-inline-block float-right text-default">{{ \General::priceFormat($shipment->pemesanan->total_awal) }}</span>
                                </li>
                                <li class="mid pb-3 text-dark">Pajak(0%)
                                    <span class="d-inline-block float-right text-default">{{ \General::priceFormat($shipment->pemesanan->jumlah_pajak) }}</span>
                                </li>
                                <li class="mid pb-3 text-dark">Biaya Pengiriman
                                    <span class="d-inline-block float-right text-default">{{ \General::priceFormat($shipment->pemesanan->biaya_pengiriman) }}</span>
                                </li>
                                <li class="pb-3 text-dark">Total Akhir
                                    <span class="d-inline-block float-right">{{ \General::priceFormat($shipment->pemesanan->total_akhir) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection