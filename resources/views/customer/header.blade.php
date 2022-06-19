<style>
    .login-btn {
        border: 1px solid rgba(0, 0, 0, .9);
        color: rgba(0, 0, 0, .9) !important;
        min-width: 120px;
    }

    .login-btn:hover {
        background: rgba(0, 0, 0, .9) !important;
        color: #FFF !important;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top" style="
border-bottom: 1px solid #ddd;
width: 100%;">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('images/logo.jpg') }}" width="70" height="50" alt="">
        Cinematic
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Credits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Equipments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tutorials</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Booking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
        @if (auth()->guard('customer')->check() ||
            auth()->guard('admin')->check())
            <ul class="navbar-nav">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline">Admin</span>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="{{ url('admin/index') }}">
                        <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                        Backoffice
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ url('admin/logout') }}">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
            </ul>
        @else
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary login-btn" href="{{ url('/login') }}">Login</a>
                </li>
            </ul>
        @endif
    </div>
</nav>
