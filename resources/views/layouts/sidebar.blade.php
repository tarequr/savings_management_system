<nav id="sidebar">
    <div class="sidebar-header">
        <div class="brand-text">SMS</div>
    </div>

    <ul class="list-unstyled components">
        <li class="section-title">DASHBOARD</li>
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="far fa-compass"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        @if(Auth::user()->isAdmin())
        <li class="section-title mt-3">AUTHORIZATION</li>
        <li class="{{ request()->routeIs('members.*') ? 'active' : '' }}">
            <a href="{{ route('members.index') }}">
                <i class="far fa-user"></i>
                <span>Members</span>
                <!-- <i class="fas fa-chevron-right arrow"></i> -->
            </a>
        </li>
        @endif

        <li class="section-title mt-3">MAIN</li>
        <li class="{{ request()->routeIs('savings.index', 'savings.create', 'savings.edit', 'savings.show') ? 'active' : '' }}">
            <a href="{{ route('savings.index') }}">
                <i class="far fa-gem"></i>
                <span>Savings Management</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('savings.history') ? 'active' : '' }}">
            <a href="{{ route('savings.history') }}">
                <i class="fas fa-history"></i>
                <span>Savings History</span>
            </a>
        </li>

        <li class="{{ request()->routeIs('loans.*') ? 'active' : '' }}">
            <a href="{{ route('loans.index') }}">
                <i class="far fa-handshake"></i>
                <span>Loans & Grants</span>
                <!-- <i class="fas fa-chevron-right arrow"></i> -->
            </a>
        </li>

        <li class="section-title mt-3">REPORTS</li>
        <li class="{{ request()->routeIs('reports.activity') ? 'active' : '' }}">
            <a href="{{ route('reports.activity') }}">
                <i class="far fa-file-alt"></i>
                <span>Activity Report</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('reports.savings') ? 'active' : '' }}">
            <a href="{{ route('reports.savings') }}">
                <i class="fas fa-file-invoice-dollar"></i>
                <span>Savings Report</span>
            </a>
        </li>
        <li class="{{ request()->routeIs('reports.loans') ? 'active' : '' }}">
            <a href="{{ route('reports.loans') }}">
                <i class="fas fa-file-contract"></i>
                <span>Loan Report</span>
            </a>
        </li>

        <li class="section-title mt-3">SETTINGS</li>
        <li class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <a href="{{ route('profile.edit') }}">
                <i class="far fa-user-circle"></i>
                <span>My Profile</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <div class="user-pill d-flex align-items-center">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=ffffff&background=2c3d94" class="rounded-circle" style="width: 24px;" alt="">
            <span class="ms-2 small text-truncate">{{ Auth::user()->name }}</span>
        </div>
    </div>
</nav>
