@component('mail::message')
# Terimakasih telah berbelanja di Sabilafresh


## NO Invoice #{{ $order->kode }} ({{\General::datetimeFormat($order->tanggal_pemesanan)}})

@component('mail::table')
| Nama Produk | Qty | harga |
| ------------- |:-------------:| --------:|
@foreach ($order->itemPemesanan as $item)
| {{ $item->nama_produk }} | {{ $item->qty }} | {{ \General::priceFormat($item->sub_total) }} |
@endforeach
| &nbsp; | <strong>Sub total</strong> | {{ \General::priceFormat($order->total_awal) }} |
| &nbsp; | Pajak (0%) | {{ \General::priceFormat($order->jumlah_pajak) }} |
| &nbsp; | Biaya Pengiriman | {{ \General::priceFormat($order->biaya_pengiriman) }} |
| &nbsp; | <strong>Total</strong> | <strong>{{ \General::priceFormat($order->total_akhir) }}</strong>|
@endcomponent

## Detail Pembeli:
<strong>{{ $order->nama_depan_konsumen }} {{ $order->nama_belakang_konsumen }}</strong>
<br> {{ $order->alamat_konsumen }}
<br> Email: {{ $order->email_konsumen }}
<br> No hp: {{ $order->no_hp_konsumen }}

## Alamat Pengiriman (Kurir : {{ $order->nama_kurir }}):
<strong>{{ $order->pengiriman->nama_depan }} {{ $order->pengiriman->nama_belakang }}</strong>
<br> {{ $order->pengiriman->alamat }}
<br> Email: {{ $order->pengiriman->email }}
<br> No hp: {{ $order->pengiriman->no_hp }}
<br> Kode Pos: {{ $order->pengiriman->kodepos }}

Terima Kasih,<br>
{{ config('app.name') }}
@endcomponent