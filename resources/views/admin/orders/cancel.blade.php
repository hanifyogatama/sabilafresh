@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Pembatalan Pesanan</h1>
    <div class="section-header-breadcrumb">
    </div>
</div>

<div class="content">
    <div class="invoice-wrapper shadow-sm rounded bg-white py-5 px-3 px-md-4 px-lg-5">
        <p class="text-dark mb-2" style="font-weight: bold; font-size:24px; text-transform: capitalize;">{{$order->kode}}</p>
        <div class="row border rounded px-3 py-3 mx-0">
            <div class="col-md-12 p-0 ">
                <p class="text-dark mb-2" style="font-weight: bold; font-size:16px; text-transform: capitalize;">Detail Pemesan</p>
                <address>
                    <div class="row pt-2">
                        <div class="col-sm-5">Nama</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $order->nama_depan_konsumen }} {{ $order->nama_belakang_konsumen }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Email</div>
                        <div class="col-sm-7 text-left text-dark"> {{ $order->email_konsumen }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">No Hp</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ $order->no_hp_konsumen }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Tanggal Pemesanan</div>
                        <div class="col-sm-7 text-left text-dark text-capitalize"> {{ \General::datetimeFormat($order->tanggal_pemesanan) }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Batas Pemesanan</div>
                        <div class="col-sm-7 text-left text-danger text-capitalize"> {{ \General::datetimeFormat($order->batas_pembayaran) }}</div>
                    </div>

                    <div class="row pt-2">
                        <div class="col-sm-5">Status Pembayaran</div>
                        <div class="col-sm-7 text-left text-success font-weight-bold text-capitalize"> {{ $order->status_pembayaran }}</div>
                    </div>
                </address>
            </div>
            <p class="text-dark mb-2" style="font-weight: bold; font-size:16px; text-transform: capitalize;">Detail Pesanan Barang</p>
            <table class="table mt-1" style="width:100%">
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
                    @forelse ($order->ItemPemesanan as $item)
                    <tr>
                        <td class="text-capitalize">{{ $item->nama_produk }}</td>
                        <td>{{ $item->qty }}</td>
                        <td>{{ $item->berat+0 }} gr</td>
                        <td>Rp {{ \General::priceFormat($item->harga) }}</td>
                        <td>Rp {{ \General::priceFormat($item->sub_total) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">pesanan kososng!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        <div class="row mt-4 justify-content-end">
            <div class="col-md-7">
                <div class="card-body">
                    <!-- @include('admin.partials.flash', ['$errors' => $errors]) -->
                    {!! Form::model($order, ['url' => ['admin/orders/cancel', $order->id], 'method' => 'PUT']) !!}
                    {!! Form::hidden('id') !!}
                    <div class="form-group">
                        {!! Form::label('catatan_pembatalan', 'Catatan Pembatalan') !!}
                        {!! Form::textarea('catatan_pembatalan', null, ['class' => 'form-control','style' =>'height: 160px !important']) !!}
                        @error('catatan_pembatalan')
                        <small style="font-weight: 600;" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Batalkan Pemesanan</button>
                        <a href="{{ url('admin/orders') }}" class="btn btn-secondary btn-default">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection