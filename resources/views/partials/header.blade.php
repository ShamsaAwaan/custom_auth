<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header d-flex justify-content-between">

            <!-- LOGO & HAMBURGER -->
            <div class="d-flex">
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{ route('dashboard') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('build/images/logo-sm.png') }}" alt="Logo" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('build/images/logo-dark.png') }}" alt="Logo" height="17">
                        </span>
                    </a>
                    <a href="{{ route('dashboard') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('build/images/logo-sm.png') }}" alt="Logo" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('build/images/logo-light.png') }}" alt="Logo" height="17">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon"><span></span><span></span><span></span></span>
                </button>

                <!-- SEARCH -->
                <form class="app-search d-none d-md-block ms-3">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                    </div>
                </form>
            </div>

            <!-- RIGHT ICONS -->
            <div class="d-flex align-items-center">

                <!-- Fullscreen -->
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle me-1" data-toggle="fullscreen">
                    <i class='bx bx-fullscreen fs-22'></i>
                </button>

                <!-- Dark Mode -->
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle me-1 light-dark-mode">
                    <i class='bx bx-moon fs-22'></i>
                </button>

                <!-- Notifications (Safe) -->
                <div class="dropdown ms-1">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle position-relative"
                            id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bx bx-bell fs-22"></i>
                        <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">0</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                        <div class="p-3 border-bottom bg-primary bg-pattern text-white">
                            <h6 class="m-0 fs-16 fw-semibold">Notifications</h6>
                        </div>
                        <div class="p-2 text-center text-muted">
                            No notifications
                        </div>
                    </div>
                </div>

                <!-- User Dropdown -->
<div class="dropdown ms-1 header-item topbar-user">
    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown">
        <span class="d-flex align-items-center">

            @if(Auth::check())
                <img class="rounded-circle header-profile-user"
                     src="{{ Auth::user()->profile_image ?? asset('build/images/users/avatar-1.jpg') }}"
                     alt="Avatar">

                <span class="d-none d-xl-inline-block ms-1 fw-medium">
                    {{ Auth::user()->firstname }}
                </span>
            @endif

        </span>
    </button>

    <div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="#">
            <i class="mdi mdi-account-circle me-1"></i> Profile
        </a>

        <a class="dropdown-item" href="#">
            <i class="mdi mdi-cog-outline me-1"></i> Settings
        </a>

        <div class="dropdown-divider"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dropdown-item">
                <i class="mdi mdi-logout me-1"></i> Logout
            </button>
        </form>
    </div>
</div>

</header>
