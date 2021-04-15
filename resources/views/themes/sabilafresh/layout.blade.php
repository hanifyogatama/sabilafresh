<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sabilafresh - eCommerce</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('themes/sabilafresh/assets/img/favicon.png') }}">
		
		<!-- all css here -->
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/pe-icon-7-stroke.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/icofont.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/meanmenu.min.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/bundle.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('themes/sabilafresh/assets/css/responsive.css') }}">
        <script src="{{ asset('themes/sabilafresh/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        @include('themes.sabilafresh.partials.header')
        
        @yield('content')
       
        
        @include('themes.sabilafresh.partials.footer')
        @include('themes.sabilafresh.partials.modals')
		
		<!-- all js here -->
        <script src="{{ asset('themes/sabilafresh/assets/js/vendor/jquery-1.12.0.min.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/popper.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/waypoints.min.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/ajax-mail.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/plugins.js') }}"></script>
        <script src="{{ asset('themes/sabilafresh/assets/js/main.js') }}"></script>
    </body>
</html>
