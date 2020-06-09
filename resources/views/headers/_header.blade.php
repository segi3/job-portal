    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid ">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-3 col-lg-2">
                                <div class="logo">
                                    <a href="/">
                                        <img src="/img/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-7">
                                <div class="main-menu  d-none d-lg-block">

                                    {{-- navbar  --}}
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="/">home</a></li>
                                            <li><a href="/jobs">Pekerjaan <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="/jobs/category/pertanian">Pertanian</a></li>
                                                    <li><a href="/jobs/category/pertambangan">Pertambangan</a></li>
                                                    <li><a href="/jobs/category/industri-dasar-dan-kimia">Industri Dasar dan Kimia</a></li>
                                                    <li><a href="/jobs/category/aneka-industri">Aneka Industri</a></li>
                                                    <li><a href="/jobs/category/industri-barang-konsumsi">Industri Barang Konsumsi</a></li>
                                                    <li><a href="/jobs/category/properti-real-estate-dan-konstruksi">Properti, Real Estate, dan Konstruksi</a></li>
                                                    <li><a href="/jobs/category/infrastruktur-utilitas-dan-transportasi">Infrastruktur, Utilitas, dan Transportasi</a></li>
                                                    <li><a href="/jobs/category/finansial">Finansial</a></li>
                                                    <li><a href="/jobs/category/perdagangan-jasa-dan-transportasi">Perdagangan, Jasa dan Transportasi</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="/jasa">Jasa<i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="/jasa/category/pertanian">Pertanian</a></li>
                                                    <li><a href="/jasa/category/pertambangan">Pertambangan</a></li>
                                                    <li><a href="/jasa/category/industri-dasar-dan-kimia">Industri Dasar dan Kimia</a></li>
                                                    <li><a href="/jasa/category/aneka-industri">Aneka Industri</a></li>
                                                    <li><a href="/jasa/category/industri-barang-konsumsi">Industri Barang Konsumsi</a></li>
                                                    <li><a href="/jasa/category/properti-real-estate-dan-konstruksi">Properti, Real Estate, dan Konstruksi</a></li>
                                                    <li><a href="/jasa/category/infrastruktur-utilitas-dan-transportasi">Infrastruktur, Utilitas, dan Transportasi</a></li>
                                                    <li><a href="/jasa/category/finansial">Finansial</a></li>
                                                    <li><a href="/jasa/category/perdagangan-jasa-dan-transportasi">Perdagangan, Jasa dan Transportasi</a></li>
                                                </ul>
                                            </li>
                                            @if(session()->has('login'))
                                            <li><a href="/dashboard">Dashboard</a></li>
                                            @endif
                                            <li class="header-login"><a href="/login-welcome">Login</a></li>
                                        </ul>
                                    </nav>
                                    {{-- end of navbar --}}

                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-lg-block">
                                <div class="Appointment">
                                    {{-- <div class="phone_num d-none d-xl-block">
                                        <a href="#">Log in</a>
                                    </div> --}}
                                    @if(session()->has('login'))
                                    <div class="d-none d-lg-block">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Logout') }}
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                    <div class="d-none d-lg-block">
                                        <a class="boxed-btn3" href="/login-welcome">Login</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
