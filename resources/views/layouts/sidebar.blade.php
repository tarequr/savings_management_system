<nav id="sidebar">
    <div class="sidebar-header">
        <div class="brand-name">SMS Dashboard</div>
        <p class="small mb-0 opacity-50 mt-1">v1.2.0 Management</p>
    </div>

    <ul class="list-unstyled components">
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="fas fa-home"></i> <span>Dashboard</span>
            </a>
        </li>
        
        @if(Auth::user()->isAdmin())
        <li class="{{ request()->routeIs('members.*') ? 'active' : '' }}">
            <a href="{{ route('members.index') }}">
                <i class="fas fa-user-friends"></i> <span>Members</span>
            </a>
        </li>
        @endif

        <li class="{{ request()->routeIs('savings.*') ? 'active' : '' }}">
            <a href="{{ route('savings.index') }}">
                <i class="fas fa-wallet"></i> <span>Savings</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('loans.*') ? 'active' : '' }}">
            <a href="{{ route('loans.index') }}">
                <i class="fas fa-hand-holding-usd"></i> <span>Loans</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer px-4 py-4" style="position: absolute; bottom: 0; width: 100%;">
        <div class="d-flex align-items-center bg-white bg-opacity-10 p-3 rounded" style="backdrop-filter: blur(5px);">
            <div class="flex-shrink-0">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=ffffff&background=2c3d94" class="rounded" style="width: 32px;" alt="">
            </div>
            <div class="flex-grow-1 ms-3 overflow-hidden">
                <p class="text-white small fw-bold mb-0 text-truncate">{{ Auth::user()->name }}</p>
                <p class="small mb-0 opacity-50 text-truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</nav>
