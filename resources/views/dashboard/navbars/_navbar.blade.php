    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/dashboard" class="nav-link">Home</a>
            </li>
        @if( session('role') == 'employer' )
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Portal utama</a>
            </li>
        @elseif ( session('role') == 'student')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Portal utama</a>
            </li>
        @elseif ( session('role') == 'guest')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Portal utama</a>
            </li>
        @endif
        </ul>

        <!-- SEARCH FORM -->
        {{-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
            </button>
            </div>
        </div>
        </form> --}}

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user-circle"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">Hi {{ session('name') }}!</span>
                <div class="dropdown-divider"></div>
                <div class="container dropdown-item dropdown-footer" style="display: block">
                    <form action="{{ url('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-block" >Logout</button>
                    </form>
                </div>
            </div>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                class="fas fa-th-large"></i></a>
        </li> --}}
        </ul>
    </nav>