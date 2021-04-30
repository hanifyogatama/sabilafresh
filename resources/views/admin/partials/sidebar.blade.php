<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Sabilafresh</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">Sf</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>


            <li class="active"><a class="nav-link" href="{{url('admin/dashboard')}}"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>

            <li class="menu-header">Menu User</li>

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-users"></i> <span>User &amp; Role</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('admin/users')}}">User</a></li>
                    @role('Admin')
                    <li><a href="{{ url('admin/roles')}}">Role</a></li>
                    @endrole
                </ul>
            </li>

            @role('Admin')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-box-open"></i><span>Katalog</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ url('admin/products')}}">Produk</a></li>
                    <li><a class="nav-link" href="{{ url('admin/categories')}}">Kategori</a></li>
                </ul>
            </li>
            @endrole

            @role('Admin')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i> <span>Cek Pemesanan</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('admin/orders')}}">Pemesanan</a></li>
                    <li><a href="{{ url('admin/shipments')}}">Pengiriman</a></li>
                </ul>
            </li>
            @endrole

            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-chart-bar"></i> <span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('admin/reports/product')}}">Produk</a></li>
                    <li><a href="{{ url('admin/reports/customer')}}">Pelanggan</a></li>
                    <li><a href="{{ url('admin/reports/payment')}}">Pembayaran</a></li>
                    <li><a href="{{ url('admin/reports/inventory')}}">Produk Inventori</a></li>
                </ul>
            </li>

            @role('Admin')
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cogs"></i><span>Setting</span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('admin/slides') }}">Slide Gambar</a></li>
                </ul>
            </li>
            @endrole
            <li><a class="nav-link" href="{{ url('admin/guides') }}"><i class="fas fa-pencil-ruler"></i> <span>Panduan</span></a></li>
        </ul>

        <!-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> -->

    </aside>
</div>