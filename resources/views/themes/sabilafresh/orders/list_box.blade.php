<div class="col-lg-12">
    <div class="shadow rounded-lg shop-page-wrapper shop-page-padding pb-30 mb-3 mx-2 pt-10">
        <div class="container">
            <div class="row pl-3">
                <div class="col-sm-1 p-0 mr-0 pt-1">
                    <img class="mt-0" src="{{ asset('themes/sabilafresh/assets/img/front/trolley.svg') }}" alt="" width="30px">
                </div>
                <div class="col-sm-9 p-0">
                    <span style="color: #03AC0E; font-weight: 600;">Belanja </span><br>
                    <span class="" style="font-size: 12px; font-weight: normal"> {{date('d F Y', strtotime($order->tanggal_pemesanan))}}</span>
                </div>

                <div class="col-sm-2 text-right pt-2">
                    @if($order->status == 'created' )
                    <span class="text-capitalize font-weight-bold border border-info rounded text-info px-2 py-1">{{ $order->status }}</span>
                    @elseif($order->status == 'completed' )
                    <span class="text-capitalize text-success font-weight-bold border border-success rounded text-white px-2 py-1">{{ $order->status }}</span>
                    @else
                    <span class="text-capitalize text-danger font-weight-bold border border-danger rounded text-white px-2 py-1">{{ $order->status }}</span>
                    @endif
                </div>

            </div>
            <hr />
            <div class="row">
                <div class="col-sm-10">
                    @foreach ($order->itemPemesanan->take(1) as $item)
                    <div class="row mt-2">
                        <div class="col-md-1">
                            <div class="px-auto">
                                <img class="mt-0" src="{{ asset('themes/sabilafresh/assets/img/front/food.svg') }}" alt="" width="40px">
                            </div>
                        </div>
                        <div class="col-md-11">
                            <span class="text-capitalize text-dark" style="font-weight: 600;">{{ $item->nama_produk }}</span> <br />
                            <span class="small">{{ $item->qty }} barang</span>
                        </div>
                    </div>
                    @endforeach

                    @if($order->itemPemesanan->count() > 1)
                    <span class="text-dark small pt-2">+{{$order->itemPemesanan->count() - 1}} produk lainnya</span>
                    @endif
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-2">
                    <span class="small">Total Belanja</span><br>
                    <span class="text-dark" style="font-weight: 600;"> Rp {{\General::priceFormat($order->total_akhir) }}</span>
                </div>
                <div class="col-sm-10 mt-2 text-right ">
                    <a href="{{ url('orders/'. $order->id) }}" class="px-4 py-2 badge badge-success">Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>