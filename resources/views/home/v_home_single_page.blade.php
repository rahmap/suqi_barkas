@extends('layouts/v_main_home')

@section('title', $title)

@section('outCSS')
<!-- SPECIFIC CSS -->
<link href="{{ asset('home/css/product_page.css') }}" rel="stylesheet">
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
        <div class="container margin_30">
            <div class="row">
                <div class="col-md-6">
                    <div class="all">
                        <div class="slider">
                            <div class="owl-carousel owl-theme main">
                                <div style="background-image: url({{ asset('storage/product/'.$produk['gambar']) }});" class="item-box"></div>
                                <div style="background-image: url({{ asset('storage/product/'.$produk['gambar_tambahan']) }});" class="item-box"></div>
                            </div>
                            <div class="left nonl"><i class="ti-angle-left"></i></div>
                            <div class="right"><i class="ti-angle-right"></i></div>
                        </div>
                        <div class="slider-two">
                            <div class="owl-carousel owl-theme thumbs">
                                <div style="background-image: url({{ asset('storage/product/'.$produk['gambar']) }});" class="item active"></div>
                                <div style="background-image: url({{ asset('storage/product/'.$produk['gambar_tambahan']) }});" class="item"></div>
                            </div>
                            <div class="left-t nonl-t"></div>
                            <div class="right-t"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- /page_header -->
                    <div class="prod_info">
                        <h1>{{ $produk['nama'] }}</h1>
                        <p><small>Kategori : <a href="{{ url('/filter?kategori=').$produk['kategoris']['slug'] }}">{{ $produk['kategoris']['nama'] }}</a></small></p>
                        <p>
                            <small>Nama Penjual :
                                <a href="{{ route('home.penjual',['user_name_slug' => $produk['users']['id'].'-'.str_replace(' ','-',strtolower($produk['users']['nama']))]) }}">
                                    {{ $produk['users']['nama'] }}
                                </a>
                            </small>
                        </p>
                        <p><small>Lokasi : {{ $produk['users']['provinsi'] }} - {{ $produk['users']['kabupaten'] }}</small></p>
                        <div class="row">
                            <div class="col-lg-5 col-md-6">
                                @if($produk['diskon'] > 0)
                                <div class="price_main"><span class="new_price">Rp {{ formatRupiah($produk['harga'] - ($produk['harga'] * $produk['diskon'] / 100)) }}</span><span class="percentage">
                                        -{{ $produk['diskon'] }}%</span> <span class="old_price">Rp {{ formatRupiah($produk['harga']) }}</span></div>
                                @else
                                    <div class="price_main"><span class="new_price">Rp {{ formatRupiah($produk['harga']) }}</span></div>
                                @endif
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <a target="_blank"
                                   href="https://wa.me/{{ $produk['users']['phone'] }}?text=Hallo *{{ $produk['users']['nama'] }}*, saya tertarik pada produk *{{ $produk['nama'] }}*">
                                    <div class="btn_add_to_cart"><button type="submit" class="btn_1">Chat Sekarang</button></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /prod_info -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->

        <div class="tabs_product">
            <div class="container">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a id="tab-A" href="#pane-A" class="nav-link active" data-toggle="tab" role="tab">Deskripsi</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /tabs_product -->
        <div class="tab_content_wrapper">
            <div class="container">
                <div class="tab-content" role="tablist">
                    <div id="pane-A" class="card tab-pane fade active show" role="tabpanel" aria-labelledby="tab-A">
                        <div class="card-header" role="tab" id="heading-A">
                            <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-A" aria-expanded="false" aria-controls="collapse-A">
                                    Deskripsi
                                </a>
                            </h5>
                        </div>
                        <div id="collapse-A" class="collapse" role="tabpanel" aria-labelledby="heading-A">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <h3>Keterangan @if($produk['kategoris']['slug'] == 'paketan' OR $produk['kategoris']['slug'] == 'paket') Paket @else Produk @endif {{ $produk['nama'] }}</h3>
                                        {!! $produk['keterangan'] !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /TAB A -->
                </div>
                <!-- /tab-content -->
            </div>
            <!-- /container -->
        </div>
        <!-- /tab_content_wrapper -->

    @if(!empty($relates))
        <div class="container margin_60_35">
            <div class="main_title">
                <h2>Related</h2>
                <span>Produk</span>
                <p>Produk yang mungkin anda suka.</p>
            </div>
            <div class="owl-carousel owl-theme products_carousel">
                @foreach($relates as $pro)
                <div class="item">
                    <div class="grid_item">
                        @if($pro['diskon'] > 0)<span class="ribbon off">-{{ $pro['diskon'] }}%</span> @endif
                        <figure>
                            <a href="{{ url('produk/'.$pro['slug']) }}">
                                <img class="img-fluid lazy" style="height: 163px" src="{{ asset('storage/product/'.$pro['gambar']) }}"
                                     data-src="{{ asset('storage/product/'.$pro['gambar']) }}" alt="Gambar {{ $pro['nama'] }}">
                            </a>
                        </figure>
                        <small><a href="{{ url('filter?kategori='.$pro['kategoris']['slug']) }}">{{ $pro['kategoris']['nama'] }}</a></small>
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
                <!-- /item -->

            </div>
            <!-- /products_carousel -->
                <!-- /col -->
        </div>
        <!-- /container -->
    @endif

    </main>
    <!-- /main -->
@endsection

@section('outJS')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.2/js/umd/util.js"></script>
<!-- SPECIFIC SCRIPTS -->
<script  src="{{ asset('home/js/carousel_with_thumbs.js') }}"></script>
<script>
    $(document).ready(function (){
        $('input[name="client_type"]').on("click", function() {
            let inputValue = $(this).attr("value");
            let targetBox = $("." + inputValue);
            $(".box").not(targetBox).hide();
            $(targetBox).show();
        });


    })
</script>
@endsection


