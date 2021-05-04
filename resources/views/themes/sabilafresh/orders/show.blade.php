@extends('themes.sabilafresh.layout')

@section('content')

<div class="shop-page-wrapper shop-page-padding ptb-150 ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                @include('themes.sabilafresh.partials.user_menu')
            </div>
            <div class="col-lg-9">
                <div class="d-flex justify-content-between">
                    <h5 class="font-weight-bold">Detail Pesanan</h5>
                </div>
                <!-- data -->
                <div class="row mb-3">
                    <div class="col">
                        <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;"></p>
                        <div class="shadow col-md-12 pb-2 px-3 rounded-lg pt-3">
                            <address>
                                Status <br /> <span class="font-weight-bold text-capitalize">
                                    @if($order->status == 'completed' )
                                    <span class="font-weight-bold text-success text-capitalize">{{ $order->status }}</span>
                                    @elseif($order->status == 'created' )
                                    <span class="font-weight-bold text-info text-capitalize">{{ $order->status }}</span>
                                    @else
                                    <span class="font-weight-bold text-danger text-capitalize">{{ $order->status }}</span>
                                    @endif

                                    {{ $order->isCancelled() ? '('. \General::datetimeFormat($order->cancelled_at) .')' : null}}
                                </span>
                                <hr class="my-3" />
                                Tanggal Pembelian<span class="font-weight-bold float-right"> {{ \General::datetimeFormat($order->tanggal_pemesanan) }}</span>
                                <hr class="my-3" />
                                Batas Pembayaran<span class="font-weight-bold float-right"> {{ \General::datetimeFormat($order->batas_pembayaran) }}</span>
                                <hr class="my-3" />

                                @if ($order->isCancelled())
                                Catatan Pembatalan: {{ $order->catatan_pembatalan}}
                                <hr class="my-3" />
                                @endif

                                Status Pembayaran
                                @if($order->status_pembayaran == 'paid' )
                                <span class="font-weight-bold text-success text-capitalize float-right">{{ $order->status_pembayaran }}</span>
                                @else
                                <span class="font-weight-bold text-danger text-capitalize float-right">{{ $order->status_pembayaran }}</span>
                                @endif
                                <hr class="my-3" />
                                <span class="font-weight-bold" style="color: #03AC0E;">{{ $order->kode }}</span>
                                <a href="{{ url('orders/received/'. $order->id) }}" class="float-right px-4 py-2 badge badge-success">Lihat</a>

                            </address>
                        </div>
                    </div>
                </div>

                @php
                $no = 1;
                @endphp
                @foreach ($order->itemPemesanan as $item)
                <div class="login mt-3 mx-3">
                    <div class="shadow bg-white rounded-lg p-0">
                        <div class="rounded-lg py-3 pl-3">
                            <span class="badge badge-info mb-1 py-1 px-2">{{$no}}</span>
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="row mt-2">
                                        <div class="col-md-1">
                                            <div class="px-auto">
                                                <img class="mt-0" src="{{ asset('themes/sabilafresh/assets/img/front/food.svg') }}" alt="" width="40px">
                                            </div>
                                        </div>

                                        <div class="col-md-11">
                                            <span class="text-capitalize text-dark" style="font-weight: 600;">{{ $item->nama_produk }}</span> <br />
                                            <span class="small">{{ $item->qty }} barang ({{$item->berat+0}} gr)</span> <br>
                                            <span class="small text-warning font-weight-bold "> Rp {{ \General::priceFormat($item->harga) }}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="mr-3" />
                            <div class="row pt-1">
                                <div class="col">
                                    <span class="small p-0">Total Harga:</span> <br>
                                    <span class="small text-warning font-weight-bold "> Rp {{ \General::priceFormat($item->sub_total) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php $no++; @endphp
                @endforeach

                <div class="login mt-3">
                    <div class="shadow pb-2 col-md-12  px-3 rounded-lg pt-3">
                        <address>
                            <span class="font-weight-bold text-dark text-capitalize">Detail Pengiriman</span>

                            <div class="row pt-3">
                                <div class="col-sm-6">Kurir Pengiriman</div>
                                <div class="col-sm-6 text-left text-dark text-capitalize">{{$order->layanan_kurir}}</div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-6">No. Resi</div>
                                <div class="col-sm-6 text-left text-dark">
                                    @if(!empty($order->pengiriman->no_resi))
                                    {{$order->pengiriman->no_resi}}
                                    @else
                                    <span class="text-success font-italic">akan ditambahkan admin</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-6">Alamat Pengiriman</div>
                                <div class="col-sm-6 text-left text-dark text-capitalize">{{$order->pengiriman->nama_depan}} {{$order->pengiriman->nama_belakang}}<br>{{$order->pengiriman->no_hp}}<br>{{$order->pengiriman->alamat}}<br>{{$order->pengiriman->kodepos}}</div>
                            </div>

                        </address>
                    </div>
                </div>

                <div class="login mt-3">
                    <div class="shadow pb-2 col-md-12  px-3 rounded-lg pt-3">
                        <address>
                            <span class="font-weight-bold text-dark text-capitalize">Informasi Pembayaran</span>
                            <address>
                                <br>
                                Metode Pembayaran<span class="font-weight-bold float-right">
                                    @foreach ($order->pembayaran as $payment)
                                    @if(!empty($payment->tipe_pembayaran))
                                    {{ucwords(str_replace("_", " ",  $payment->tipe_pembayaran))}}
                                    @else
                                    <span class="text-success font-italic">belum melakukan pembayaran</span>
                                    @endif

                                    @endforeach
                                </span>
                                <hr class="my-3" />

                                Total Harga ({{$order->pengiriman->total_qty }} barang)<span class="font-weight-bold float-right"> Rp {{ \General::priceFormat($order->total_awal) }}</span>
                                <hr class="my-3" />

                                Total Ongkos Kirim ({{$order->pengiriman->total_berat }} gr)<span class="font-weight-bold float-right"> Rp {{ \General::priceFormat($order->biaya_pengiriman) }}</span>
                                <hr class="my-3" />

                                Pajak ({{$order->persen_pajak+0}}%)<span class="font-weight-bold float-right"> Rp {{$order->jumlah_pajak+0}}</span>
                                <hr class="my-3" />

                                <span class="font-weight-bold">Total Bayar</span><span class="font-weight-bold float-right text-success"> Rp {{ \General::priceFormat($order->total_akhir) }}</span>
                                <br>

                            </address>
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection