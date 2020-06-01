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
                <a href="#" class="nav-link
                {{ Request::is('dashboard/er/create-job') ? "active" : "" }}
                {{ Request::is('dashboard/er/job-approval') ? "active" : "" }}
                {{ Request::is('dashboard/er/job-applicant-pending') ? "active" : "" }}
                {{ Request::is('dashboard/er/job-applicant-accepted') ? "active" : "" }}
                ">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                    Manage Jobs
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/dashboard/er/create-job" class="nav-link {{ Request::is('dashboard/er/create-job') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Post new job</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/er/job-approval" class="nav-link {{ Request::is('dashboard/er/job-approval') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View jobs approval</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/er/job-applicant-pending" class="nav-link {{ Request::is('dashboard/er/job-applicant-pending') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pending applicants</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/er/job-applicant-accepted" class="nav-link {{ Request::is('dashboard/er/job-applicant-accepted') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Accepted applicants</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link
                {{ Request::is('dashboard/er/create-seminar') ? "active" : "" }}
                {{ Request::is('dashboard/er/seminar-approval') ? "active" : "" }}
                ">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>
                    Manage Seminars
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/dashboard/er/create-seminar" class="nav-link {{ Request::is('dashboard/er/create-seminar') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Post new seminar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/er/seminar-approval" class="nav-link {{ Request::is('dashboard/er/seminar-approval') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>View seminars approval</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="/dashboard/er/profile" class="nav-link {{ Request::is('dashboard/er/profile') ? "active" : "" }}">
                <i class="nav-icon fas fa-address-card"></i>
                <p>My Profile</p>
                </a>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>