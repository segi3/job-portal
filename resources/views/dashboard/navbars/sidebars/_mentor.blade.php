<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
    <img src="/img/dashboard_logo.png" alt="ALogo ITS" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">ITS JobX Mentor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item has-treeview
        {{ Request::is('mentor/list-peserta-IYT') ? "menu-open" : "" }}
        {{ Request::is('mentor/#2') ? "menu-open" : "" }}
        {{ Request::is('mentor/#3') ? "menu-open" : "" }}
        ">
            <a href="#" class="nav-link
            {{ Request::is('mentor/list-peserta-IYT') ? "active" : "" }}
            {{ Request::is('mentor/#2') ? "active" : "" }}
            {{ Request::is('mentor/#3') ? "active" : "" }}
            ">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                Peserta
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/mentor/list-peserta-IYT" class="nav-link {{ Request::is('mentor/list-peserta-IYT') ? "active" : "" }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List Peserta</p>
                </a>
            </li>
            </ul>
        </li>

        <li class="nav-item has-treeview
        {{ Request::is('mentor/IYT-create-mentoring') ? "menu-open" : "" }}
        {{ Request::is('mentor/IYT-list-mentoring') ? "menu-open" : "" }}
        {{ Request::is('mentor/#3') ? "menu-open" : "" }}
        ">
            <a href="#" class="nav-link
            {{ Request::is('mentor/IYT-create-mentoring') ? "active" : "" }}
            {{ Request::is('mentor/IYT-list-mentoring') ? "active" : "" }}
            {{ Request::is('mentor/#3') ? "active" : "" }}
            ">
            <i class="nav-icon fas fa-address-card"></i>
            <p>
                Jadwal
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/mentor/IYT-list-mentoring" class="nav-link {{ Request::is('mentor/IYT-list-mentoring') ? "active" : "" }}">
                <i class="far fa-circle nav-icon"></i>
                <p>List Jadwal</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/mentor/IYT-create-mentoring" class="nav-link {{ Request::is('mentor/IYT-create-mentoring') ? "active" : "" }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Buat Jadwal</p>
                </a>
            </li>
            </ul>
        </li>


        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
