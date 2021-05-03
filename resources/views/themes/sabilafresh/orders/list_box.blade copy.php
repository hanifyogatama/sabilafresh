<div class="col-lg-12">
    <div class="shadow rounded-lg shop-page-wrapper shop-page-padding ptb-30 mb-3 mx-2">
        <div class="container">
            <div class="row mb-5">
                <img class="mt-0" src="{{ asset('themes/sabilafresh/assets/img/front/trolley.svg') }}" alt="" width="30px">
            </div>
            <div class="row">
                <div class="col-md-10">


                    <span style="color: #03AC0E; font-weight: bold;">{{ $order->kode }}</span><br>
                    <span>Total : Rp {{\General::priceFormat($order->total_akhir) }}</span><br>
                    Status Pembelian : <span class="badge badge-info">{{ $order->status }}</span><br>
                    Status Pembayaran :
                    @if($order->status_pembayaran == 'paid' )
                    <span class="badge badge-success">{{ $order->status_pembayaran }}</span>
                    @else
                    <span class="badge badge-danger text-white">{{ $order->status_pembayaran }}</span>
                    @endif

                    <br>
                    <br>

                    <span style="font-size: 12px; font-weight: normal"> {{date('d F Y', strtotime($order->tanggal_pemesanan))}}</span>
                </div>
                <div class="col-md-2  ">
                    <div class="img pt-5" style="background-image: url('{{ asset('themes/sabilafresh/assets/img/front/bag-fruits.svg') }}'); margin:0;  height: 127px; background-repeat: no-repeat; background-position:right; ">
                        <a href="{{ url('orders/'. $order->id) }}" class=" mt-5  btn btn-light-green btn-sm">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>