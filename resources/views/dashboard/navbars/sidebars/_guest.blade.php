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
                <li class="nav-item
                {{ Request::is('dashboard/gs/list-jasa') ? "active" : "" }}
                ">
                    <a href="/dashboard/gs/list-jasa" class="nav-link
                    {{ Request::is('dashboard/gs/list-jasa') ? "active" : "" }}
                    ">
                        <i class="far fa-clock nav-icon"></i>
                        <p>
                            Services Waiting Approval
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/gs/list-jasa-rejected"
                        class="nav-link {{ Request::is('dashboard/gs/list-jasa-rejected') ? "active" : "" }}">
                        <i class="far fa-times-circle nav-icon"></i>
                        <p>
                            Services Rejected
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/gs/list-jasa-inprogress"
                        class="nav-link {{ Request::is('dashboard/gs/list-jasa-inprogress') ? "active" : "" }}">
                        <i class="far fa-hourglass nav-icon"></i>
                        <p>
                            Services In Progress
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/dashboard/gs/list-jasa-done"
                        class="nav-link {{ Request::is('dashboard/gs/list-jasa-done') ? "active" : "" }}">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>
                            Services Done
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>

                <li class="nav-item has-treeview
                {{ Request::is('dashboard/gs/orders') ? "menu-open" : "" }}
                {{ Request::is('dashboard/gs/on-going-project-list') ? "menu-open" : "" }}
                ">
                    <a href="#" class="nav-link
                    {{ Request::is('dashboard/gs/orders') ? "active" : "" }}
                    {{ Request::is('dashboard/gs/on-going-project-list') ? "active" : "" }}
                    ">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Investasi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/gs/orders"
                                class="nav-link {{ Request::is('dashboard/gs/orders') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/gs/on-going-project-list"
                                class="nav-link {{ Request::is('dashboard/gs/on-going-project-list') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>On-Going Project</p>
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
