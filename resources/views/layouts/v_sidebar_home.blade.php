@if(!isset($pageNama))
<aside class="col-lg-3" id="sidebar_fixed">
    <div class="filter_col">
        <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
        <form action="{{ route('filter') }}" method="get">
        <div class="filter_type version_2">
            <h4><a href="#filter_1" data-toggle="collapse" class="opened">Kategori</a></h4>
            <div class="collapse show" id="filter_1">
                <ul>
                    <li>
                        <label class="container_check">All
                            <input type="radio"
                                   value="all"
                                   @if(isset($_GET['kategori']) AND $_GET['kategori'] == 'all' OR empty($_GET['kategori'])) checked @endif
                                   name="kategori">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    @foreach($kategoris as $kat)
                    <li>
                        <label class="container_check">{{ $kat['nama'] }} <small>{{ count($kat['produks']) }}</small>
                            <input type="radio" value="{{ $kat['slug'] }}" @if(isset($_GET['kategori']) AND $_GET['kategori'] == $kat['slug']) checked @endif name="kategori">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- /filter_type -->
        </div>
        <div class="filter_type version_2">
            <h4><a href="#filter_2" data-toggle="collapse" class="opened">Provinsi</a></h4>
            <div class="collapse show" id="filter_2">
                <ul>
                    <li>
                        <label class="container_check">All
                            <input type="radio"
                                   value="all"
                                   @if(isset($_GET['provinsi']) AND $_GET['provinsi'] == 'all' OR empty($_GET['provinsi'])) checked @endif
                            name="provinsi">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    @foreach($locationsProv as $prov)
                    <li>
                        <label class="container_check">{{ ucwords($prov['provinsi']) }}
                            <input type="radio"
                                   value="{{ str_replace(' ', '-',strtolower($prov['provinsi'])) }}"
                                   @if(isset($_GET['provinsi']) AND $_GET['provinsi'] == str_replace(' ', '-',strtolower($prov['provinsi']))) checked @endif
                            name="provinsi">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- /filter_type -->
        </div>
        <div class="filter_type version_2">
            <h4><a href="#filter_3" data-toggle="collapse" class="opened">Kebupaten</a></h4>
            <div class="collapse show" id="filter_3">
                <ul>
                    <li>
                        <label class="container_check">All
                            <input type="radio"
                                   value="all"
                                   @if(isset($_GET['kabupaten']) AND $_GET['kabupaten'] == 'all' OR empty($_GET['kabupaten'])) checked @endif
                                   name="kabupaten">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    @foreach($locationsKab as $kab)
                    <li>
                        <label class="container_check">{{ ucwords($kab['kabupaten']) }}
                            <input type="radio"
                                   value="{{ str_replace(' ', '-',strtolower($kab['kabupaten'])) }}"
                                   @if(isset($_GET['kabupaten']) AND $_GET['kabupaten'] == str_replace(' ', '-',strtolower($kab['kabupaten']))) checked @endif
                                   name="kabupaten">
                            <span class="checkmark"></span>
                        </label>
                    </li>
                    @endforeach
                </ul>
            </div>
            <!-- /filter_type -->
        </div>

        <!-- /filter_type -->
        <div class="buttons text-center">
            <button class="btn_1" type="submit">Filter</button>
            <button type="reset" class="btn_1 gray">Reset</button>
        </div>
        </form>
    </div>
</aside>
@endif
