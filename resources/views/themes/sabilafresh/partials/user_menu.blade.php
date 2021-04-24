<div class="shadow sidebar-widget mb-45 p-4 mx-2 bg-white rounded-lg ">
    <div class="row">
        <div class="col-lg-3 mx-auto my-auto">
            <img class="rounded-circle " src=" {{ asset('themes/sabilafresh/assets/img/front/icon-user.jpg') }}" alt="" width="50px">
        </div>
        <div class="col-lg-9 mt-3">
            <p class="text-left pl-2 text-capitalize" style="color: #03AC0E; font-weight: 600;">{{ Auth::user()->nama_depan }}</p>
        </div>
    </div>
    <div class="mt-3">
        <hr />
    </div>

    <div class="sidebar-title mt-2">Profil Saya</div>
    <div class="sidebar-categories">
        <p><a href="{{ url('profile') }}">Biodata Diri</a></p>
        <!-- <p><a href="{{ url('orders') }}">Riwayat Transaksi</a></p> -->
        <p><a href="{{ url('favorites') }}">Wishlist</a></p>
    </div>
</div>