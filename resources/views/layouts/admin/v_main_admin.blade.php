<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Admin</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">

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

@include('layouts.admin.partials.topbar')

<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        @yield('contents')

        @include('layouts.admin.partials.footer')
    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

@include('layouts.admin.partials.sidebar')

<!-- JAVASCRIPT -->
<script src="{{ asset('dashboard/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/metismenu/metisMenu.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('dashboard/libs/node-waves/waves.min.js') }}"></script>

<script src="{{ asset('dashboard/js/app.js') }}"></script>

@yield('outJS')

</body>
</html>
