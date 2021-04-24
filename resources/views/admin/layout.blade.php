<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Sabilafresh</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('admin/assets/modules/fontawesome/css/all.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/modules/summernote/summernote-bs4.css') }}">

    <link rel=" stylesheet" href="{{ URL::asset('admin/assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/assets/css/components.css') }}">


</head>

<body>
    <div id="app">
        <div class="main-wrapper">


            @include('admin.partials.header')

            @include('admin.partials.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">

                    @yield('content')

                </section>
            </div>

            @include('admin.partials.footer')
        </div>
    </div>

    <!-- General JS Scripts -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->




    <!-- General JS Scripts -->
    <script src="{{ URL::asset('admin/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/popper.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/tooltip.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/moment.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ URL::asset('admin/assets/modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/chart.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ URL::asset('admin/assets/js/page/index.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ URL::asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/custom.js') }}"></script>

    @if(Session::has('success-add'))
    <script>
        iziToast.success({
            title: 'Sukses',
            message: 'Data Berhasil Disimpan',
            position: 'topRight',
        });
    </script>
    @endif
    @if(Session::has('success-edit'))
    <script>
        iziToast.success({
            title: 'Sukses',
            message: 'Data Berhasil Diedit',
            position: 'topRight',
        });
    </script>
    @endif

    @if(Session::has('success-delete'))
    <script>
        iziToast.success({
            title: 'Sukses',
            message: 'Data Berhasil Dihapus',
            position: 'topRight',
        });
    </script>
    @endif

    @if(Session::has('login-success'))
    <script>
        iziToast.info({
            title: 'Login Berhasil',
            message: 'Selamat Datang',
            position: 'topCenter',
        });
    </script>
    @endif


    <script>
        $(".delete").on("submit", function() {
            return confirm("Yakin ingin menghapus data?");
        });

        function showHideConfigurableAttributes() {
            var productType = $(".product-type").val();

            if (productType == 'configurable') {
                $(".configurable-attributes").show();
            } else {
                $(".configurable-attributes").hide();
            }
        }

        $(function() {
            showHideConfigurableAttributes();
            $(".product-type").change(function() {
                showHideConfigurableAttributes();
            });
        });
    </script>

</body>

</html>