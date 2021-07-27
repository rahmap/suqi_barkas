<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - {{ getenv('APP_NAME') }}</title>
    <meta name="description" content="{{ getenv('APP_NAME') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<!-- Favicons-->
    <link rel="shortcut icon" href="<?= asset('home/img/favicon.png') ?>" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="<?= asset('home/img/favicon.png') ?>">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="<?= asset('home/img/favicon.png') ?>">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="<?= asset('home/img/favicon.png') ?>">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="<?= asset('home/img/favicon.png') ?>">
    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
          integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- BASE CSS -->
    <link href="<?= asset('home/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= asset('home/css/style.css') ?>" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    @yield('outCSS')

<!-- YOUR CUSTOM CSS -->
    <link href="<?= asset('home/css/custom.css') ?>" rel="stylesheet">
</head>

<body>

@if (\session()->has('message'))
    {!! \session()->get('message') !!}
@endif

<div id="page">
    <header class="version_2">
        <div class="layer"></div><!-- Mobile menu overlay mask -->
        <div class="main_header">
            <div class="container">
                <div class="row small-gutters">
                    <div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
                        <div id="logo">
                            <a href="<?= route('home') ?>"><img src="<?= asset('home/img/logo_belisc.png') ?>" alt="" width="100" height="40"></a>
                        </div>
                    </div>
                    <nav class="col-xl-9 col-lg-9">
                        <a class="open_close" href="javascript:void(0);">
                            <div class="hamburger hamburger--spin">
                                <div class="hamburger-box">
                                    <div class="hamburger-inner"></div>
                                </div>
                            </div>
                        </a>
                        <!-- Mobile menu button -->
                        <div class="main-menu">
                            <div id="header_menu">
                                <a href="<?= route('home') ?>"><img src="<?= asset('home/img/logo_belisc.png') ?>" alt="" width="150" height="45"></a>
                                <a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
                            </div>
                            <ul>
                                <li>
                                    <a href="<?= route('home') ?>">Home</a>
                                </li>
                                <li class="submenu">
                                    <a href="javascript:void(0);" class="show-submenu">Extra Pages</a>
                                    <ul>
                                        <li><a href="{{ route('about') }}">Tentang</a></li>
                                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                                        <li><a href="{{ route('faq') }}">Syarat & Ketentuan</a></li>
                                    </ul>
                                </li>
                                @if(auth()->guard('admin')->check())
                                    <li>
                                        <a href="<?= route('admin_index') ?>"><i class="fas fa-bars"></i> Dashboard (Admin)</a>
                                    </li>
                                    <li>
                                        <a href="<?= route('auth_logout_admin') ?>"><i class="fas fa-sign-out-alt"></i> Keluar (Admin)</a>
                                    </li>
                                @endif
                                @if(auth()->guard('customer')->check())
                                    <li>
                                        <a href="<?= route('customer_index') ?>"><i class="fas fa-bars"></i> Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="<?= route('auth_logout') ?>"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                                    </li>
                                    <?php else: ?>
                                    <li>
                                        <a href="<?= route('auth') ?>"><i class="fas fa-sign-in-alt"></i> Masuk / Buat Akun</a>
                                    </li>
                                 @endif
                            </ul>
                        </div>
                        <!--/main-menu -->
                    </nav>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /main_header -->

        <div class="main_nav Sticky">
            <div class="container">
                <div class="row small-gutters">
                    <div class="col-xl-3 col-lg-3 col-md-3">
                        <nav class="categories">
                            <ul class="clearfix">
                                <li><span>
										<a href="<?= url('/') ?>">
											<span class="hamburger hamburger--spin">
												<span class="hamburger-box">
													<span class="hamburger-inner"></span>
												</span>
											</span>
											Home
										</a>
									</span>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
                        <form action="<?= route('search') ?>" method="GET">
                            <div class="custom-search-input">
                                <input type="text" value="<?= old('nama', (isset($_GET['nama']) AND !empty($_GET['nama']))?
                                    $_GET['nama'] : '') ?>" placeholder="Cari Properti berdasarkan nama.." name="nama" required>
                                <button type="submit"><i class="header-icon_search_custom"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-3 col-lg-2 col-md-3">
                        <ul class="top_tools">
                            <li>
                                <div class="dropdown dropdown-access">
                                    <?php if(auth()->guard('customer')->check()): ?>
                                    <a href="<?= route('customer_index') ?>" class="access_link"><span>Dashboard</span></a>
                                    <?php else: ?>
                                    <a href="<?= route('auth') ?>" class="access_link"><span>Account</span></a>
                                    <?php endif; ?>
                                    <div class="dropdown-menu">
                                        <?php if(!auth()->guard('customer')->check()): ?>
                                        <a href="<?= route('auth') ?>" class="btn_1">Masuk / Buat Akun</a>
                                        <?php else: ?>
                                        <a href="<?= route('customer_index') ?>" class="btn_1">Dashboard</a>
                                        <?php endif; ?>
                                        <ul>
                                            <?php if(auth()->guard('customer')->check()): ?>
                                            <li>
                                                <a href="<?= route('auth_logout') ?>"><b><i class="ti-power-off"></i>Keluar</b></a>
                                            </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /dropdown-access-->
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="btn_search_mob"><span>Search</span></a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <div class="search_mob_wp">
                <form action="<?= route('search') ?>" method="GET">
                    <input type="text" name="nama" value="<?= old('nama', (isset($_GET['nama']) AND !empty($_GET['nama']))?
                        $_GET['nama'] : '') ?>" class="form-control" required
                           placeholder="Cari Properti berdasarkan nama..">
                    <button type="submit" class="btn_1 full-width">Cari</button>
                </form>
            </div>
            <!-- /search_mobile -->
        </div>
        <!-- /main_nav -->
    </header>
    <!-- /header -->



    <!--shop main area are start-->
    @yield('contents')
    <!--shop main area are end-->

    <!-- footer start-->
    <footer class="revealed">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_1">Quick Links</h3>
                    <div class="collapse dont-collapse-sm links" id="collapse_1">
                        <ul>
                            @if(auth()->guard('customer')->check())
                            <li><a href="{{ route('customer_index') }}">Dashboard</a></li>
                            @else
                            <li><a href="{{ route('auth') }}">Login / Registrasi</a></li>
                            @endif
                            <li><a href="{{ route('about') }}">Tentang</a></li>
                            <li><a href="{{ route('contact') }}">Kontak</a></li>
                            <li><a href="{{ route('faq') }}">Syarat & Ketentuan</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_2">Kategori</h3>
                    <div class="collapse dont-collapse-sm links" id="collapse_2">
                        <ul>
                            @foreach($kategoriConstruct as $kat)
                            <li><a href="{{ url('/filter?kategori=').$kat['slug'] }}">{{ $kat['nama'] }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 data-target="#collapse_3">Kontak</h3>
                    <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                        <ul>
                            <li><i class="ti-home"></i>97845 Baker st. 567<br>Los Angeles - US</li>
                            <li><i class="ti-headphone-alt"></i>+94 423-23-221</li>
                            <li><i class="ti-email"></i><a href="#0">info@allaia.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">

                </div>
            </div>
            <!-- /row-->
            <hr>
            <div class="row add_bottom_25">
                <div class="col-lg-6">
                    <ul class="footer-selector clearfix">
                        <li>

                        </li>
                        <li>

                        </li>
                        <li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="additional_links">
                        <li><span>© {{ date('Y') }} {{ getenv('APP_NAME') }}</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!--/footer-->

</div>

<div id="toTop"></div><!-- Back to top button -->

<!-- jquery latest version -->
<!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>-->

<!-- COMMON SCRIPTS -->
<script src="<?= asset('home/js/common_scripts.min.js') ?>"></script>
<script src="<?= asset('home/js/main.js') ?>"></script>
@yield('outJS')
<script>
    $(document).ready(function () {

    });
</script>
</body>

</html>
