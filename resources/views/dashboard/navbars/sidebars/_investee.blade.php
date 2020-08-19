<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
    <img src="/img/dashboard_logo.png" alt="ALogo ITS" class="brand-image img-circle elevation-3"
        style="opacity: .8">
    <span class="brand-text font-weight-light">ITS JobX</span>
    </a>

    <!-- Sidebar -->
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

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link {{ Request::is('dashboard/st/job-approval') ? "active" : "" }}">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              IYT
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/dashboard/investee/dummy" class="nav-link {{ Request::is('dashboard/st/job-approval') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Submenu#1</p>
                </a>
            </li>
            </ul>
        </li>

        <li class="nav-item has-treeview
        {{ Request::is('dashboard/investee/create-project-investment') ? "menu-open" : "" }}
        {{ Request::is('dashboard/investee/investment-project-list') ? "menu-open" : "" }}
        ">
            <a href="#" class="nav-link
            {{ Request::is('dashboard/investee/create-project-investment') ? "active" : "" }}
            {{ Request::is('dashboard/investee/investment-project-list') ? "active" : "" }}
            ">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Investasi Project
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/dashboard/investee/create-project-investment" class="nav-link {{ Request::is('dashboard/investee/create-project-investment') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Buat Project</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/dashboard/investee/investment-project-list" class="nav-link {{ Request::is('dashboard/investee/investment-project-list') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>on-going project</p>
                </a>
            </li>
            </ul>
        </li>

        <li class="nav-item has-treeview
        {{ Request::is('dashboard/investee/create-funding-investment') ? "menu-open" : "" }}
        ">
            <a href="#" class="nav-link
            {{ Request::is('dashboard/investee/create-funding-investment') ? "active" : "" }}
            ">
            <i class="nav-icon fas fa-chalkboard-teacher"></i>
            <p>
              Investasi Fund
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/dashboard/investee/create-funding-investment" class="nav-link {{ Request::is('dashboard/investee/create-funding-investment') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Buat Funding</p>
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