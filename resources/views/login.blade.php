@extends('layouts.app')

@section('title', 'Login POS')

@section('content')

<style>
    .login-bg {
        background: linear-gradient(135deg, #FAF8F4 0%, #ECE6FB 100%);
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }
    .login-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px -8px rgba(43, 42, 40, 0.12);
        overflow: hidden;
    }
    .login-icon-box {
        width: 56px;
        height: 56px;
        margin: 0 auto 0.75rem;
        background: var(--accent-primary);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
    }
    .login-card .form-control {
        border-color: var(--border-color);
    }
    .login-card .form-control:focus {
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 0.2rem rgba(109, 79, 209, 0.15);
    }
    .btn-login {
        background: var(--accent-primary);
        color: #ffffff;
        border: none;
        transition: all 0.2s ease;
    }
    .btn-login:hover {
        background: var(--accent-primary-dark);
        color: #ffffff;
    }
</style>

<div class="login-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                <div class="login-card card">
                    <!-- Header -->
                    <div class="card-header bg-white border-0 text-center py-4">
                        <div class="login-icon-box">
                            <i class="bi bi-speedometer2"></i>
                        </div>
                        <h3 class="fw-bold mb-1" style="color: var(--text-primary);">POS Daffa</h3>
                        <p class="mb-0" style="color: var(--text-muted);">Silakan masuk ke akun Anda</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        @if(session('login_lockout_seconds'))
                            <div class="alert alert-warning small" role="alert">
                                Login dikunci sementara. Coba lagi dalam
                                <strong id="login-countdown">{{ session('login_lockout_seconds') }}</strong> detik.
                            </div>
                        @endif

                        <form action="{{ route('auth') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-medium" style="color: var(--text-secondary);">Email Address</label>
                                <input type="email"
                                       name="email"
                                       class="form-control form-control-lg rounded-3"
                                       value="{{ old('email') }}"
                                       placeholder="nama@email.com">
                                @error('email')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium" style="color: var(--text-secondary);">Password</label>
                                <input type="password"
                                       name="password"
                                       class="form-control form-control-lg rounded-3"
                                       placeholder="••••••••"
                                       {{ session('login_lockout_seconds') ? 'disabled' : '' }}>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-login btn-lg w-100 rounded-3 py-3 fw-medium" {{ session('login_lockout_seconds') ? 'disabled' : '' }}>
                                MASUK
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <small style="color: var(--text-muted);">Belum punya akun? Hubungi Admin</small>
                        </div>
                    </div>
                </div>

                <!-- Optional Footer -->
                <div class="text-center mt-4" style="color: var(--text-muted);">
                    <small>&copy; {{ date('Y') }} POS Daffa</small>
                </div>

            </div>
        </div>
    </div>
</div>

@if(session('login_lockout_seconds'))
    <script>
        let remaining = {{ session('login_lockout_seconds') }};
        const countdown = document.getElementById('login-countdown');
        const timer = setInterval(() => {
            remaining -= 1;
            countdown.textContent = Math.max(remaining, 0);

            if (remaining <= 0) {
                clearInterval(timer);
                window.location.reload();
            }
        }, 1000);
    </script>
@endif

@endsection
