<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Self service portal | Narok County Government</title>
    <link rel="shortcut icon" href="{{ asset('img/logo-files/county-logo.png') }}" type="image/x-icon">
    <!-- fonts -->
    <link rel="stylesheet" href="{{ asset('vendors/icon_fonts/css/all_icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/icon_fonts/css/elegant-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/icon_fonts/css/fontello-codes.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/icon_fonts/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/icon_fonts/css/icon_set_1.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/icon_fonts/css/icon_set_2.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/icon_fonts/css/icon_set_3.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/icon_fonts/css/icon_set_4.css') }}">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.9.55/css/materialdesignicons.min.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- css -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <!-- preloader -->
    <div class="preloader show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#056c5f" />
        </svg>
    </div>

    @yield('content')


    <!-- js -->
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('js/jquery.parallax-1.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('vendors/moment/moment.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvEEMx3XDpByNzYNn0n62Zsq_sVYPx1zY"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @yield('scripts')

</body>

</html>
