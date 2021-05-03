<div class="shadow rounded-lg shop-page-wrapper shop-page-padding ptb-30 ">
    <div class="container">
        <div class="row">
            @forelse ($orders as $order)
            
            @include('themes.sabilafresh.orders.list_box')
            @empty
            <div class="col">
                <div class="row mx-auto">
                    <img class="mx-auto" src="{{ asset('themes/sabilafresh/assets/img/front/empty.svg') }}" alt="" width="270px">
                </div>
                <div class="row">
                    <p class="mx-auto">Anda tidak memiliki riwayat transaksi.<a href="/" style="color: #03AC0E;"> Mulai belanja</a></p>
                </div>
            </div>
            @endforelse
            <div class="mx-auto mt-3">{{ $orders->links() }}</div>
        </div>


    </div>
</div>