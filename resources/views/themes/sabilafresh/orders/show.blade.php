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
                    <h5 class="font-weight-bold" style="color: #03AC0E;"> #{{ $order->kode }}</h5>
                </div>
                <!-- timeline start -->


                <div class="row mb-3">
                   

                    <div class="col">
                        <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;"></p>
                        <div class="shadow col-md-12 border px-3 rounded-lg pt-3">
                            <address>
                                ID: <span class="font-weight-bold"> {{ $order->kode }}</span>
                                <br>Tanggal Pemesanan:<span class="font-weight-bold"> {{ \General::datetimeFormat($order->tanggal_pemesanan) }}</span>
                                <br>Batas Pembayaran:<span class="font-weight-bold"> {{ \General::datetimeFormat($order->batas_pembayaran) }}</span>

                                <br> Status:<span class="font-weight-bold"> {{ $order->status }} {{ $order->isCancelled() ? '('. \General::datetimeFormat($order->cancelled_at) .')' : null}}</span>

                                @if ($order->isCancelled())
                                <br>Catatan Pembatalan: {{ $order->catatan_pembatalan}}
                                @endif

                                <br> Status Pembayaran:
                                @if($order->status_pembayaran == 'paid' )
                                <span class="font-weight-bold text-success text-capitalize">{{ $order->status_pembayaran }}</span>
                                @else
                                <span class="font-weight-bold text-danger text-capitalize">{{ $order->status_pembayaran }}</span>
                                @endif
                            </address>
                        </div>
                    </div>
                </div>

                <!-- timeline end -->
                <div class="login pt-1">
                    <div class="shadow login-form-container bg-white rounded-lg pt-4">

                        <div class="rounded-lg mt-2 py-2">
                            <table class="table  ">
                                <thead>
                                    <tr>
                                        <!-- <th>#</th> -->
                                        <th>Nama Barang</th>
                                        <th>Qty</th>
                                        <th>Harga Satuan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($order->itemPemesanan as $item)
                                    <tr>
                                        <td>{{ $item->nama_produk }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rp {{ \General::priceFormat($item->harga) }}</td>
                                        <td>Rp {{ \General::priceFormat($item->sub_total) }}</td>

                                    </tr>
                                    <td rowspan="3">Rp {{ \General::priceFormat($order->total_akhir) }}</td>
                                    @empty
                                    <tr>
                                        <td colspan="6">Order item not found!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection