<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
        </ul>

    </form>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ URL::asset('admin/assets/img/avatar/profile-1.png') }}" class=" rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Str::limit(Auth::user()->nama_depan , 11) }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title text-center"><span class="text-primary">{{ date('d-F-Y') }}</span></div>

                @role('Admin')
                <a class="dropdown-item has-icon text-center">Admin</a>
                @endrole
                @role('Owner')
                <a class="dropdown-item has-icon text-center">Owner</a>
                @endrole
                <div class="dropdown-divider"></div>
                <a href="{{ url('admin/users/'. \Auth::user()->id) }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>