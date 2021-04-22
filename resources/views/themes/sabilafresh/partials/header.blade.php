<!-- header start -->
<header>
    <div class="header-top-furniture wrapper-padding-1 res-header-sm fixed-top shadow bg-white">
        <div class="container-fluid">
            <div class="header-bottom-wrapper">
                <div class="logo-2 furniture-logo ptb-30 ml-10 mr-20">
                    <a href="/">
                        <img src="{{ asset('themes/sabilafresh/assets/img/front/new-logo.svg') }}" alt="" width="155px">
                    </a>
                </div>

                <div class="furniture-search mt-4">
                    <form action="{{ url('products') }}" method="GET">
                        <input class="form-control rounded-lg" placeholder="Mau cari apa?" type="text" name="q" autocomplete="off" value="{{ isset($q) ? $q : null }}">
                        <button>
                            <i class="ti-search"></i>
                        </button>
                    </form>

                    <div class="pt-1 pb-1">
                        <a style="font-size: 13px;" href="{{ url('products') }}">Semua Produk</a>
                    </div>

                </div>

                <div class="header-cart-4 mt-1">
                    <a class="icon-cart-furniture" href="{{ url('favorites') }}"><i style="color: #6C727C;" class="fa fa-heart"></i></a></li>
                </div>

                @include('themes.sabilafresh.partials.mini_cart')

                <span class="my-auto" style="width: 0.5px; background: #00000061; height: 20px; padding-bottom: 5px;"></span>
                <div class="furniture-login mr-2">
                    <ul>
                        @guest
                        <li><a class="btn btn-outline-success btn-sm bg-white m-1 mb-1" href="{{ url('login') }}" style="color: #03AC0E;">Masuk</a></li>
                        <li><a class="btn btn-light-green btn-sm mb-1 mt-1" style="color: white;" href="{{ url('register') }}">Daftar</a></li>
                        @else
                        <div class="menu-style furniture-menu menu-hover">
                            <nav>
                                <ul>
                                    <li>
                                        <img class="rounded-circle " src=" {{ asset('themes/sabilafresh/assets/img/front/icon-user.jpg') }}" alt="" width="25px">

                                        <a class="ml-1 text-capitalize" style="color: #00000061; font-weight: 400;" href="#">{{ Auth::user()->nama_depan }}</a>
                                        <ul class="single-dropdown">

                                            <div class="shadow bg-white rounded-lg py-2 p-2 mb-2">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <img class="shadow rounded-circle my-0" src=" {{ asset('themes/sabilafresh/assets/img/front/icon-user.jpg') }}" alt="" width="40px">
                                                    </div>
                                                    <div class="col-md-10">
                                                        <span class="text-dark font-weight-bold text-capitalize">{{ Auth::User()->nama_depan }} {{ Auth::User()->nama_belakang }} </span>
                                                        <div><i class="fa fa-certificate"></i> Member</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 pr-0">
                                                    <li class="pb-0"><a href="{{ url('profile') }}">Ubah Profil</a></li>
                                                    <hr />
                                                    <li class="pb-0"><a href="{{ url('orders') }}">Riwayat Pembelian</a></li>
                                                    <hr />
                                                    <li class="pb-0"><a href="{{ url('favorites') }}">Wishlist</a></li>
                                                </div>
                                                <div class="col-md-6">
                                                    <li><a style="color: red;" href="{{ route('logout') }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                            <i class="fa fa-sign-out ml-1"></i></a></li>
                                                </div>
                                            </div>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endguest
                    </ul>
                </div>
            </div>

            <!-- mobile device -->
            <div class="row">
                <div class="mobile-menu-area d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="#">HOME</a>
                                    <ul>
                                        <li><a href="index.html">Fashion</a></li>
                                        <li><a href="index-fashion-2.html">Fashion style 2</a></li>
                                        <li><a href="index-fruits.html">Fruits</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">pages</a>
                                    <ul>
                                        <li><a href="about-us.html">about us</a></li>
                                        <li><a href="menu-list.html">menu list</a></li>
                                        <li><a href="login.html">login</a></li>
                                        <li><a href="register.html">register</a></li>
                                        <li><a href="cart.html">cart page</a></li>
                                        <li><a href="checkout.html">checkout</a></li>
                                        <li><a href="wishlist.html">wishlist</a></li>
                                        <li><a href="contact.html">contact</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">shop</a>
                                    <ul>
                                        <li><a href="shop-grid-2-col.html"> grid 2 column</a></li>
                                        <li><a href="shop-grid-3-col.html"> grid 3 column</a></li>
                                        <li><a href="shop.html">grid 4 column</a></li>
                                        <li><a href="shop-grid-box.html">grid box style</a></li>
                                        <li><a href="shop-list-1-col.html"> list 1 column</a></li>
                                        <li><a href="shop-list-2-col.html">list 2 column</a></li>
                                        <li><a href="shop-list-box.html">list box style</a></li>
                                        <li><a href="product-details.html">tab style 1</a></li>
                                        <li><a href="product-details-2.html">tab style 2</a></li>
                                        <li><a href="product-details-3.html"> tab style 3</a></li>
                                        <li><a href="product-details-4.html">sticky style</a></li>
                                        <li><a href="product-details-5.html">sticky style 2</a></li>
                                        <li><a href="product-details-6.html">gallery style</a></li>
                                        <li><a href="product-details-7.html">gallery style 2</a></li>
                                        <li><a href="product-details-8.html">fixed image style</a></li>
                                        <li><a href="product-details-9.html">fixed image style 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">BLOG</a>
                                    <ul>
                                        <li><a href="blog.html">blog 3 colunm</a></li>
                                        <li><a href="blog-2-col.html">blog 2 colunm</a></li>
                                        <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                        <li><a href="blog-details.html">blog details</a></li>
                                        <li><a href="blog-details-sidebar.html">blog details 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="contact.html"> Contact </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom-furniture wrapper-padding-2 border-top-3 ">
        <div class="container-fluid">
            <!-- <div class="furniture-bottom-wrapper">
                <div class="furniture-login">
                    <ul>
                        @guest
                        <li>Get Access: <a href="{{ url('login') }}">Login</a></li>
                        <li><a href="{{ url('register') }}">Register</a></li>
                        @else
                        <li>Hello: <a href="{{ url('profile') }}">{{ Auth::user()->first_name }}</a></li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endguest
                    </ul>
                </div>
                <div class="furniture-search">
                    <form action="{{ url('products') }}" method="GET">
                        <input placeholder="Mau cari apa . . ." type="text" name="wordSearch" value="{{ isset($wordSearch) ? $wordSearch : null }}">
                        <button>
                            <i class="ti-search"></i>
                        </button>
                    </form>
                </div>
                <div class="furniture-wishlist">
                    <ul>
                        <li><a href="{{ url('favorites') }}"><i class="ti-heart"></i> Favorites</a></li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</header>
<!-- header end -->