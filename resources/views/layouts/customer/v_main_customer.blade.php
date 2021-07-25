<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Customer</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">

    <!-- slick css -->
    <link href="{{ asset('dashboard/libs/slick-slider/slick/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard/libs/slick-slider/slick/slick-theme.css') }}" rel="stylesheet" type="text/css" />

    <!-- jvectormap -->
    <link href="{{ asset('dashboard/libs/jqvmap/jqvmap.min.css') }}" rel="stylesheet" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('dashboard/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('dashboard/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    @yield('outCSS')

</head>

<body data-topbar="dark" >

<!-- Begin page -->
<div id="layout-wrapper">

@include('layouts.customer.partials.topbar')

<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        @yield('contents')

        @include('layouts.customer.partials.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

@include('layouts.customer.partials.sidebar')

<!-- JAVASCRIPT -->
<script src="{{ asset('dashboard/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/node-waves/waves.min.js') }}"></script>

<!-- apexcharts -->
<script src="{{ asset('dashboard/libs/apexcharts/apexcharts.min.js') }}"></script>

<script src="{{ asset('dashboard/libs/slick-slider/slick/slick.min.js') }}"></script>

<!-- Jq vector map -->
<script src="{{ asset('dashboard/libs/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

<script src="{{ asset('dashboard/js/pages/dashboard.init.js') }}"></script>

<script src="{{ asset('dashboard/js/app.js') }}"></script>

@yield('outJS')

</body>
</html>
