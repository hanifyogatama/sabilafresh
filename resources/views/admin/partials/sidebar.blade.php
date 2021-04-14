<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Sabilafresh</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">Sf</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>


            <li class="active"><a class="nav-link" href="{{url('admin/dashboard')}}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

            <li class="menu-header">Menu User</li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>Users &amp; Roles</span></a>
                <ul class="dropdown-menu">
                    <li><a href="auth-forgot-password.html">Users</a></li>
                    <li><a href="auth-login.html">Roles</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box-open"></i><span>Katalog</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ url('admin/products')}}">Produk</a></li>
                    <li><a class="nav-link" href="{{ url('admin/attributes')}}">Produk Atribut</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Produk Gambar</a></li>
                    <li><a class="nav-link" href="{{ url('admin/categories')}}">Kategori</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i> <span>Cek Pemesanan</span></a>
                <ul class="dropdown-menu">
                    <li><a href="auth-forgot-password.html">Pemesanan</a></li>
                    <li><a href="auth-login.html">Pengiriman</a></li>
                    <li><a href="auth-login.html">Sampah</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-bar"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li><a href="auth-forgot-password.html">Produk</a></li>
                    <li><a href="auth-forgot-password.html">Produk Inventori</a></li>
                    <li><a href="auth-forgot-password.html">Pendapatan</a></li>
                    <li><a href="auth-login.html">Pembayaran</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i> <span>Setting</span></a>
                <ul class="dropdown-menu">
                    <li><a href="utilities-contact.html">Slides</a></li>
                </ul>
            </li>
        </ul>

        <!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> -->

    </aside>
</div>