<aside class="col-lg-3" id="sidebar_fixed">
    <div class="filter_col">
        <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
        <form action="{{ route('filter') }}" method="get">
        <div class="filter_type version_2">
            <h4><a href="#filter_1" data-toggle="collapse" class="opened">Kategori</a></h4>
            <div class="collapse show" id="filter_1">
                <ul>
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

        <!-- /filter_type -->
        <div class="buttons text-center">
            <button class="btn_1" type="submit">Filter</button> <button type="reset" class="btn_1 gray">Reset</button>
        </div>
        </form>
    </div>
</aside>
