@extends('layouts/v_main_home')

@section('title', $title)

@section('outCSS')
<!-- SPECIFIC CSS -->
<link href="<?= asset('home/css/listing.css') ?>" rel="stylesheet">

<style>
    /* already defined in bootstrap4 */
    .text-xs-center {
        text-align: center;
    }

    .g-recaptcha {
        display: inline-block;
    }
</style>
@endsection

@section('contents')
    <main>
        <div class="top_banner">
            <div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
                <div class="container">
                    <div class="breadcrumbs">

                    </div>
                    <h1>{{ $title }} - {{ getenv('APP_NAME') }}</h1>
                    <h6>Menampilkan Barang Bekas dari Penjual <strong>{{ $user['nama'] }}</strong></h6>
                </div>
            </div>
            <img src="home/img/bg_cat_shoes.jpg" class="img-fluid" alt="">
        </div>
        <!-- /top_banner -->
        <div id="stick_here"></div>
        <div class="toolbox elemento_stick">
            <div class="container">
                <ul class="clearfix">
                    <li>

                    </li>
                    <li>

                    </li>
                    <li>
                        <a href="#0" class="open_filters">
                            <i class="ti-filter"></i><span>Filters</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /toolbox -->
        <div class="container">

            <div class="row">
                @include('layouts.v_sidebar_home')
                <!-- /col -->
                <div class="col-lg-12">
                    <div class="row small-gutters">
                        @if(!$produks->isEmpty())
                            @foreach($produks as $pro)
                                <div class="col-6 col-md-3">
                                    <div class="grid_item">
                                        @if($pro['diskon'] > 0)<span class="ribbon off">-{{ $pro['diskon'] }}%</span> @endif
                                        <figure>
                                            <a href="{{ url('produk/'.$pro['slug']) }}">
                                                <img class="img-fluid lazy" style="height: 163px" src="{{ asset('storage/product/'.$pro['gambar']) }}"
                                                     data-src="{{ asset('storage/product/'.$pro['gambar']) }}" alt="Gambar {{ $pro['nama'] }}">
                                            </a>
                                        </figure>
                                        <small><a href="{{ url('/filter?kategori=').$pro['kategoris']['slug'] }}">{{ $pro['kategoris']['nama'] }}</a></small>
                                        <br>
                                        <a href="{{ url('produk/'.$pro['slug']) }}">
                                            <h3>{{ $pro['nama'] }}</h3>
                                        </a>
                                        <div class="price_box">
                                            <span class="new_price">Rp {{ formatRupiah($pro['harga'] = $pro['harga'] - ($pro['harga'] * $pro['diskon'] / 100)) }}</span>
                                        </div>
                                        <ul>

                                        </ul>
                                    </div>
                                    <!-- /grid_item -->
                                </div>
                            @endforeach
                        <!-- /col -->
                        @else
                            <div class="col-12 col-md-12">
                                <div class="text-center">
                                    <h3>Tidak ada data Produk</h3>
                                </div>
                            </div>
                        @endif

                    </div>
                   @if(!empty($produks)) {!! $produks->links() !!} @endif
                </div>
                <!-- /col -->
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->
    </main>
    <!-- /main -->
@endsection

@section('outJS')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.2/js/umd/util.js"></script>
<!-- SPECIFIC SCRIPTS -->
<script src="{{ asset('home/js/sticky_sidebar.min.js') }}"></script>
<script src="{{ asset('home/js/specific_listing.js') }}"></script>
<script>
    $(document).ready(function (){
        $('input[name="client_type"]').on("click", function() {
            let inputValue = $(this).attr("value");
            let targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });
        let pagi =  $('.pagination')
        let nav = pagi.parents('nav')
        nav.addClass('pagination__wrapper')

        pagi.find('li.active').removeAttr('class').children(this).addClass('active')

    })
</script>
@endsection


