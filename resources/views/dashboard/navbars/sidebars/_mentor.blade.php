<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
    <img src="/img/dashboard_logo.png" alt="ALogo ITS" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">ITS JobX mentor</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item has-treeview
        {{ Request::is('mentor/#1') ? "menu-open" : "" }}
        {{ Request::is('mentor/#2') ? "menu-open" : "" }}
        {{ Request::is('mentor/#3') ? "menu-open" : "" }}
        ">
            <a href="#" class="nav-link
            {{ Request::is('mentor/#1') ? "active" : "" }}
            {{ Request::is('mentor/#2') ? "active" : "" }}
            {{ Request::is('mentor/#3') ? "active" : "" }}
            ">
            <i class="nav-icon fas fa-user-friends"></i>
            <p>
                Manage IYT
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="mentor/#1" class="nav-link {{ Request::is('mentor/#1') ? "active" : "" }}">
                <i class="far fa-circle nav-icon"></i>
                <p>#1</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/mentor/#2" class="nav-link {{ Request::is('mentor/#2') ? "active" : "" }}">
                <i class="far fa-circle nav-icon"></i>
                <p>#2</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/mentor/#3" class="nav-link {{ Request::is('mentor/#3') ? "active" : "" }}">
                <i class="far fa-circle nav-icon"></i>
                <p>#3</p>
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
