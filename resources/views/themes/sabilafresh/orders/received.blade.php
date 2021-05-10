@extends('themes.sabilafresh.layout')

@section('content')
<!-- header end -->

<!-- checkout-area start -->
<div class="cart-main-area ptb-100 plr-70">
    <div class="container pt-50">
        @include('admin.partials.flash', ['$errors' => $errors])
        <div class="row">
            <div class="col-md-8">
                <a href="">
                    <img src="{{ asset('themes/sabilafresh/assets/img/front/new-logo.svg') }}" alt="" width="140px">
                </a>
                <br><br>
                <span class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: capitalize;">Nomor Invoice: </span><span class="text-success font-weight-bold">{{ $order->kode }}</span>
                <p class="mt-2 mb-0">Diterbitkan atas nama:</p>
                <address>
                    <div class="row">
                        <div class="col-md-2">
                            <ul class="font-weight-bold">
                                <li>Penjual</li>
                                <li>Tanggal</li>
                            </ul>
                        </div>
                        <div class="col-md">
                            <ul>
                                <li>Sabilafresh</li>
                                <li>{{ \General::datetimeFormat($order->tanggal_pemesanan) }}</li>
                            </ul>
                        </div>
                    </div>
                </address>
            </div>
            <div class="col-md-4">
                <p class="text-dark mb-2" style="font-weight: bold; font-size:17px; text-transform: capitalize;">Tujuan Pengiriman</p>
                <address>
                    <span class="text-capitalize font-weight-bold text-dark">{{ $order->pengiriman->nama_depan }} {{ $order->pengiriman->nama_belakang }}</span>
                    <br> {{ $order->pengiriman->no_hp }}
                    <br> {{ $order->pengiriman->alamat }}
                    <br> {{ $order->pengiriman->kodepos }}

                </address>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table mt-3 " style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumah</th>
                                <th>Berat Satuan</th>
                                <th>Harga Barang</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($order->itemPemesanan as $item)
                            <tr>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{$item->berat+0}} gr</td>
                                <td>Rp {{ \General::priceFormat($item->harga) }}</td>
                                <td>Rp {{ \General::priceFormat($item->sub_total) }}</td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6">kosong!</td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                    <hr class="mt-0" />
                </div>
                <div class="row">
                    <div class="col-md-5 ml-auto">
                        <div class="row mx-0 pt-10">
                            <div class="col-md-12 py-3">
                                <div class="row pb-2">
                                    <div class="col-sm-8">
                                        <span class="text-dark font-weight-bold">Sub total Harga Barang </span>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="text-dark font-weight-bold">Rp {{ \General::priceFormat($order->total_awal) }}</span>
                                    </div>
                                </div>
                                <hr />
                                <div class="row pb-2 pt-2">
                                    <div class="col-sm-8">
                                        <span class="text-dark">{{ $order->layanan_kurir }} </span>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="text-dark">Rp {{ \General::priceFormat($order->biaya_pengiriman) }}</span>
                                    </div>
                                </div>
                                <hr />
                                <div class="row pb-2 pt-2">
                                    <div class="col-sm-8">
                                        <span class="text-dark">Pajak({{$order->persen_pajak+0}}%) </span>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="text-dark">Rp {{ \General::priceFormat($order->jumlah_pajak) }}</span>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>

                        <div class="row mx-3 border pb-0">
                            <div class="col-md-12 pt-3 pb-2">
                                <div class="row pb-2">
                                    <div class="col-sm-8">
                                        <span class="text-dark font-weight-bold">Total Bayar </span>
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="text-dark font-weight-bold">Rp {{ \General::priceFormat($order->total_akhir) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @if(!$order->isPaid())
                        <div class="float-right mr-3 mt-3">
                            <a class="btn btn-light-green btn-sm px-3" href="{{ $order->url_pembayaran }}">Bayar</a>
                        </div>
                        @else
                        <div class="mx-auto d-block mb-3" style="background-image: url('{{ asset('themes/sabilafresh/assets/img/front/paid.svg') }}');  height: 140px; background-repeat: no-repeat; background-position: right; ">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection