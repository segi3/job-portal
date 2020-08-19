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
                <li class="nav-item has-treeview
                {{ Request::is('dashboard/st/profile') ? "menu-open" : "" }}
                {{ Request::is('dashboard/st/profile/edit') ? "menu-open" : "" }}
                ">
                    <a href="#" class="nav-link
                    {{ Request::is('dashboard/st/profile') ? "active" : "" }}
                    {{ Request::is('dashboard/st/profile/edit') ? "active" : "" }}
                    ">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            My Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/st/profile"
                                class="nav-link {{ Request::is('dashboard/st/profile') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/st/profile/edit"
                                class="nav-link {{ Request::is('dashboard/st/profile/edit') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Edit Profile</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview
                {{ Request::is('dashboard/st/create-service') ? "menu-open" : "" }}
                {{ Request::is('dashboard/st/service-approval') ? "menu-open" : "" }}
                {{ Request::is('dashboard/st/service-applicant-pending') ? "menu-open" : "" }}
                {{ Request::is('dashboard/st/service-applicant-accepted') ? "menu-open" : "" }}
                ">
                    <a href="#" class="nav-link
                    {{ Request::is('dashboard/st/create-service') ? "active" : "" }}
                    {{ Request::is('dashboard/st/service-approval') ? "active" : "" }}
                    {{ Request::is('dashboard/st/service-applicant-pending') ? "active" : "" }}
                    {{ Request::is('dashboard/st/service-applicant-accepted') ? "active" : "" }}
                    ">
                        <i class="nav-icon fas fa-briefcase"></i>
                        <p>
                            Manage Services
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/st/create-service"
                                class="nav-link {{ Request::is('dashboard/st/create-service') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Post new service</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/st/service-approval"
                                class="nav-link {{ Request::is('dashboard/st/service-approval') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View services approval</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/st/service-applicant-pending"
                                class="nav-link {{ Request::is('dashboard/st/service-applicant-pending') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending applicants</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/st/service-applicant-accepted"
                                class="nav-link {{ Request::is('dashboard/st/service-applicant-accepted') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Accepted applicants</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview
                {{ Request::is('dashboard/st/job-approval') ? "menu-open" : "" }}
                ">
                    <a href="#" class="nav-link
                    {{ Request::is('dashboard/st/job-approval') ? "active" : "" }}
                    ">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Manage Jobs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/st/job-approval"
                                class="nav-link {{ Request::is('dashboard/st/job-approval') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View jobs approval</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview
                {{ Request::is('dashboard/st/job-approval') ? "menu-open" : "" }}
                ">
                    <a href="#" class="nav-link
                    {{ Request::is('dashboard/st/job-approval') ? "active" : "" }}
                    ">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            Investasi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/dashboard/st/orders"
                                class="nav-link {{ Request::is('dashboard/st/job-approval') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/dashboard/st/on-going-project-list"
                                class="nav-link {{ Request::is('dashboard/st/on-going-project-list') ? "active" : "" }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>On-Going Project</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <hr>
                <a class="btn btn-primary" href="/dashboard/investee">Investasi</a>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
