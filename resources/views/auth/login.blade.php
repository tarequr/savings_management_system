<x-guest-layout>
    <div class="mb-4">
        <h4 class="fw-bold text-dark mb-1">Welcome Back</h4>
        <p class="text-muted small">Please enter your credentials to access your account.</p>
    </div>

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus placeholder="name@example.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" class="form-label mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none small" style="color: #2c3d94;">Forgot Password?</a>
                @endif
            </div>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="Enter your password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" name="remember" id="remember_me" class="form-check-input mt-0" style="width: 1rem; height: 1rem;">
                <label class="form-check-label text-muted small ms-1" for="remember_me">Keep me logged in</label>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center">
                Sign In
            </button>
        </div>
    </form>
</x-guest-layout>
