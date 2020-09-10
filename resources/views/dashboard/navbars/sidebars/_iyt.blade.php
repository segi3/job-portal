<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/dashboard" class="brand-link">
        <img src="/img/dashboard_logo.png" alt="ALogo ITS" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ITS JobX</span>
    </a>

    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div> --}}

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview
                    {{ Request::is('dashboard/IYT/notulensi') ? "menu-open" : "" }}
                    ">
                    <a href="#" class="nav-link
                    {{ Request::is('dashboard/IYT/notulensi') ? "active" : "" }}
                    ">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Coaching
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/IYT/notulensi"
                                class="nav-link {{ Request::is('dashboard/IYT/notulensi') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Notulensi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview
                    {{ Request::is('dashboard/IYT/submit-laporan-bulanan') ? "menu-open" : "" }}
                    ">
                    <a href="#" class="nav-link
                    {{ Request::is('dashboard/IYT/submit-laporan-bulanan') ? "active" : "" }}
                    ">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Submit Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/IYT/submit-laporan-bulanan"
                                class="nav-link {{ Request::is('dashboard/IYT/submit-laporan-bulanan') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Progres Laporan Bulanan</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
