    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/dashboard" class="brand-link">
        <img src="/img/dashboard_logo.png" alt="ALogo ITS" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">ITS JobX Admin</span>
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

            <li class="nav-item has-treeview {{ Request::is('admin/user-list') ? "menu-open" : "" }}">
                <a href="#" class="nav-link {{ Request::is('admin/user-list') ? "active" : "" }}">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                    Manage Students
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/user-list" class="nav-link {{ Request::is('admin/user-list') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Student list</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-item has-treeview
            {{ Request::is('admin/new-services') ? "menu-open" : "" }}
            {{ Request::is('admin/approved-services') ? "menu-open" : "" }}
            {{ Request::is('admin/unapproved-services') ? "menu-open" : "" }}
            ">
                <a href="#" class="nav-link
                {{ Request::is('admin/new-services') ? "active" : "" }}
                {{ Request::is('admin/approved-services') ? "active" : "" }}
                {{ Request::is('admin/unapproved-services') ? "active" : "" }}
                ">
                    <i class="nav-icon fas fa-briefcase"></i>
                <p>
                    Manage Services
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/new-services" class="nav-link {{ Request::is('admin/new-services') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New Services</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/approved-services" class="nav-link {{ Request::is('admin/approved-services') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Approved Services</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/unapproved-services" class="nav-link {{ Request::is('admin/unapproved-services') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Unapproved Services</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-item has-treeview
            {{ Request::is('admin/new-employers') ? "menu-open" : "" }}
            {{ Request::is('admin/approved-employers') ? "menu-open" : "" }}
            {{ Request::is('admin/unapproved-employers') ? "menu-open" : "" }}
            ">
                <a href="#" class="nav-link
                {{ Request::is('admin/new-employers') ? "active" : "" }}
                {{ Request::is('admin/approved-employers') ? "active" : "" }}
                {{ Request::is('admin/unapproved-employers') ? "active" : "" }}
                    ">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                    Manage Employers
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/new-employers" class="nav-link {{ Request::is('admin/new-employers') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New employers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/approved-employers" class="nav-link {{ Request::is('admin/approved-employers') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Approved employers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/unapproved-employers" class="nav-link {{ Request::is('admin/unapproved-employers') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Unapproved employers</p>
                    </a>
                </li>
                </ul>
            </li>


            <li class="nav-item has-treeview
            {{ Request::is('admin/new-guests') ? "menu-open" : "" }}
            {{ Request::is('admin/approved-guests') ? "menu-open" : "" }}
            {{ Request::is('admin/unapproved-guests') ? "menu-open" : "" }}
            ">
                <a href="#" class="nav-link
                {{ Request::is('admin/new-guests') ? "menu-open" : "" }}
                {{ Request::is('admin/approved-guests') ? "menu-open" : "" }}
                {{ Request::is('admin/unapproved-guests') ? "menu-open" : "" }}
                    ">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                    Manage Guests
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/new-guests" class="nav-link {{ Request::is('admin/new-guests') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New Guests</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/approved-guests" class="nav-link {{ Request::is('admin/approved-guests') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Approved Guests</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/unapproved-guests" class="nav-link {{ Request::is('admin/unapproved-guests') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Unapproved Guests</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-item has-treeview
            {{ Request::is('admin/new-jobs') ? "active" : "" }}
            {{ Request::is('admin/approved-jobs') ? "active" : "" }}
            {{ Request::is('admin/unapproved-jobs') ? "active" : "" }}
            ">
                <a href="#" class="nav-link
                    {{ Request::is('admin/new-jobs') ? "active" : "" }}
                    {{ Request::is('admin/approved-jobs') ? "active" : "" }}
                    {{ Request::is('admin/unapproved-jobs') ? "active" : "" }}
                    ">
                <i class="nav-icon fas fa-briefcase"></i>
                <p>
                    Manage Jobs
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/new-jobs" class="nav-link {{ Request::is('admin/new-jobs') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New jobs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/approved-jobs" class="nav-link {{ Request::is('admin/approved-jobs') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Approved jobs</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/unapproved-jobs" class="nav-link {{ Request::is('admin/unapproved-jobs') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Unapproved jobs</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-item has-treeview
                {{ Request::is('admin/new-seminars') ? "menu-open" : "" }}
                {{ Request::is('admin/approved-seminars') ? "menu-open" : "" }}
                {{ Request::is('admin/unapproved-seminars') ? "menu-open" : "" }}
            ">
                <a href="#" class="nav-link
                    {{ Request::is('admin/new-seminars') ? "active" : "" }}
                    {{ Request::is('admin/approved-seminars') ? "active" : "" }}
                    {{ Request::is('admin/unapproved-seminars') ? "active" : "" }}
                    ">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>
                    Manage Seminars
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/new-seminars" class="nav-link {{ Request::is('admin/new-seminars') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New seminars</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/approved-seminars" class="nav-link {{ Request::is('admin/approved-seminars') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Approved seminars</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/unapproved-seminars" class="nav-link {{ Request::is('admin/unapproved-seminars') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Unapproved seminars</p>
                    </a>
                </li>
                </ul>
            </li>

            <li class="nav-item has-treeview
                {{ Request::is('admin/new-investment') ? "menu-open" : "" }}
                {{ Request::is('admin/approved-investment') ? "menu-open" : "" }}
                {{ Request::is('admin/unapproved-investment') ? "menu-open" : "" }}
            ">
                <a href="#" class="nav-link
                    {{ Request::is('admin/new-investment') ? "active" : "" }}
                    {{ Request::is('admin/approved-investment') ? "active" : "" }}
                    {{ Request::is('admin/unapproved-investment') ? "active" : "" }}
                    ">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <p>
                    Manage Investment
                    <i class="right fas fa-angle-left"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="/admin/new-investment" class="nav-link {{ Request::is('admin/new-investment') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>New Investment</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/approved-investment" class="nav-link {{ Request::is('admin/approved-investment') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Approved Investment</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/unapproved-investment" class="nav-link {{ Request::is('admin/unapproved-investment') ? "active" : "" }}">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Unapproved Investment</p>
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
