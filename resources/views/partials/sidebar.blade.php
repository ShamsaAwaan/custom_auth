<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="{{ url('/dashboard') }}" class="logo logo-dark">
            <span class="logo-sm"><img src="{{ URL::asset('build/images/logo-sm.png') }}" height="22"></span>
            <span class="logo-lg"><img src="{{ URL::asset('build/images/logo-dark.png') }}" height="17"></span>
        </a>
        <a href="{{ url('/dashboard') }}" class="logo logo-light">
            <span class="logo-sm"><img src="{{ URL::asset('build/images/logo-sm.png') }}" height="22"></span>
            <span class="logo-lg"><img src="{{ URL::asset('build/images/logo-light.png') }}" height="17"></span>
        </a>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url('/dashboard') }}">
                        <i class="ri-dashboard-line"></i> <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-file-list-line"></i> <span data-key="t-tasks">Tasks</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-shopping-cart-line"></i> <span data-key="t-ecommerce">Ecommerce</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
