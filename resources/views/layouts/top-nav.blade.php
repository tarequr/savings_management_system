<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-outline-secondary border-0 btn-sm me-3">
            <i class="fas fa-align-left"></i>
        </button>

        <div class="ms-auto d-flex align-items-center">
            
            <!-- Breadcrumbs / Status -->
            <div class="me-3 d-none d-md-block">
                <span class="badge bg-light text-dark border py-2 px-3 fw-normal">
                    <i class="fas fa-calendar-alt text-primary me-2"></i> {{ date('F d, Y') }}
                </span>
            </div>

            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=ffffff&background=2c3d94" class="rounded me-2 shadow-sm" style="width: 34px; height: 34px;" alt="Avatar">
                    <div class="d-none d-sm-block text-start">
                        <p class="small fw-bold mb-0 leading-tight">{{ Auth::user()->name }}</p>
                        <p class="extra-small text-muted mb-0">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2 mt-3" style="min-width: 200px;" aria-labelledby="navbarDropdown">
                    <li class="px-3 py-2 border-bottom mb-2">
                        <p class="small text-muted mb-0">Logged in as</p>
                        <p class="small fw-bold mb-0">{{ Auth::user()->email }}</p>
                    </li>
                    <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="fas fa-cog fa-sm me-2 text-muted"></i> Account Settings</a></li>
                    <li><hr class="dropdown-divider opacity-50"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 text-danger">
                                <i class="fas fa-sign-out-alt fa-sm me-2"></i> Sign Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<style>
    .extra-small { font-size: 0.7rem; }
</style>
