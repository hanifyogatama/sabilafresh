@extends('admin.layout')

@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Pembatalan Pesanan #{{ $order->kode }}</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    {!! Form::model($order, ['url' => ['admin/orders/cancel', $order->id], 'method' => 'PUT']) !!}
                    {!! Form::hidden('id') !!}
                    <div class="form-group">
                        {!! Form::label('catatan_pembatalan', 'Catatan Pembatalan') !!}
                        {!! Form::textarea('catatan_pembatalan', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Batalkan Pemesanan</button>
                        <a href="{{ url('admin/orders') }}" class="btn btn-secondary btn-default">Kembali</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Detail Pemesanan</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6">
                            <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Detail Pengiriman</p>
                            <address>
                                {{ $order->nama_depan_konsumen }} {{ $order->nama_belakang_konsumen }}
                                <br> {{ $order->alamat_konsumen }}
                                <br> Email: {{ $order->email_konsumen }}
                                <br> No Hp: {{ $order->no_hp_konsumen }}
                                <br> Kode Pos: {{ $order->kode_pos_konsumen }}
                            </address>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Detail</p>
                            <address>
                                ID: <span class="text-dark">#{{ $order->kode }}</span>
                                <br> {{ \General::datetimeFormat($order->tanggal_pemesanan) }}
                                <br> Status: {{ $order->status }}
                                <br> Payment Status: {{ $order->status_pembayaran }}
                                <br> Shipped by: {{ $order->layanan_kurir }}
                            </address>
                        </div>
                    </div>
                    <table class="table mt-3 table-striped table-responsive table-responsive-large" style="width:100%">
                        <thead>
                            <tr>
                              
                                <th>Produk</th>
                                <th>Banyak</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->itemPemesanan as $item)
                            <tr>
                               
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ \General::priceFormat($item->sub_total) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">Produk pesanan kosong</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="row justify-content-end">
                        <div class="col-lg-5 col-xl-6 col-xl-3 ml-sm-auto">
                            <ul class="list-unstyled mt-4">
                                <li class="mid pb-3 text-dark">Sub total
                                    <span class="d-inline-block float-right text-default">{{ \General::priceFormat($order->total_awal) }}</span>
                                </li>
                                <li class="mid pb-3 text-dark">Pajak(0%)
                                    <span class="d-inline-block float-right text-default">{{ \General::priceFormat($order->jumlah_diskon) }}</span>
                                </li>
                                <li class="mid pb-3 text-dark">Biaya Pengiriman
                                    <span class="d-inline-block float-right text-default">{{ \General::priceFormat($order->biaya_pengiriman) }}</span>
                                </li>
                                <li class="pb-3 text-dark">Total Akhir
                                    <span class="d-inline-block float-right">{{ \General::priceFormat($order->total_akhir) }}</span>
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