@extends('themes.sabilafresh.layout')

@section('content')
<!-- header end -->

<!-- checkout-area start -->
<div class="cart-main-area  ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                @include('admin.partials.flash', ['$errors' => $errors])
                <h1 class="cart-heading">Your Order:</h4>
                    <div class="row">
                        <div class="col-xl-3 col-lg-4">
                            <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Billing Address</p>
                            <address>
                                {{ $order->nama_depan_konsumen }} {{ $order->nama_belakang_konsumen }}
                                <br> {{ $order->alamat_konsumen }}
                                <br> Email: {{ $order->email_konsumen }}
                                <br> Phone: {{ $order->no_hp_konsumen }}
                                <br> Postcode: {{ $order->kodepos_konsumen }}
                            </address>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Shipment Address</p>
                            <address>
                                {{ $order->pengiriman->nama_depan }} {{ $order->pengiriman->nama_belakang }}
                                <br> {{ $order->pengiriman->alamat }}

                                <br> Email: {{ $order->pengiriman->email }}
                                <br> Phone: {{ $order->pengiriman->no_hp }}
                                <br> Postcode: {{ $order->pengiriman->kodepos }}
                            </address>
                        </div>
                        <div class="col-xl-3 col-lg-4">
                            <p class="text-dark mb-2" style="font-weight: normal; font-size:16px; text-transform: uppercase;">Details</p>
                            <address>
                                Invoice ID:
                                <span class="text-dark">#{{ $order->kode }}</span>
                                <br> {{ \General::datetimeFormat($order->tanggal_pemesanan) }}
                                <br> Shipped by: {{ $order->layanan_kurir }}
                            </address>
                        </div>
                    </div>
                    <div class="table-content table-responsive">
                        <table class="table mt-3 table-striped table-responsive table-responsive-large" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Cost</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->itemPemesanan as $item)
                                <tr>
                                    <td>{{ $item->sku }}</td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>{!! \General::showAttributes($item->atribut) !!}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ \General::priceFormat($item->harga) }}</td>
                                    <td>{{ \General::priceFormat($item->sub_total) }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Order item not found!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <ul>
                                    <li> Subtotal
                                        <span>{{ \General::priceFormat($order->total_awal) }}</span>
                                    </li>
                                    <li>Tax (0%)
                                        <span>{{ \General::priceFormat($order->jumlah_pajak) }}</span>
                                    </li>
                                    <li>Shipping Cost
                                        <span>{{ \General::priceFormat($order->biaya_pengiriman) }}</span>
                                    </li>
                                    <li>Total
                                        <span>{{ \General::priceFormat($order->total_akhir) }}</span>
                                    </li>
                                </ul>
                                <a href="#">Proceed to payment</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection