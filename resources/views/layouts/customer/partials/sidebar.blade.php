<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('customer_index') }}" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-google-pages"></i>
                        <span>Produk</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('produk.create') }}">Tambah Produk</a></li>
                        <li><a href="{{ route('produk.index') }}">List Produk</a></li>
                    </ul>
                </li>



                <li class="menu-title">Tools</li>
                <li>
                    <a href="{{ route('update_profile_customer') }}" class=" waves-effect">
                        <i class="mdi mdi-calendar-month"></i>
                        <span>Profile</span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
