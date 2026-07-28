@extends('layouts.app')

@section('title', 'Login POS')

@section('content')

<style>
    .login-bg {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 50%, #c4d0ff 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }
</style>

<div class="login-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">

                <div class="login-card card">
                    <!-- Header -->
                    <div class="card-header bg-white border-0 text-center py-4">
                        <h3 class="fw-bold text-primary mb-1">
                            <i class="bi bi-speedometer2"></i> POS
                        </h3>
                        <p class="text-muted mb-0">Silakan masuk ke akun Anda</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <form action="{{ route('auth') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label fw-medium">Email Address</label>
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
                                <label class="form-label fw-medium">Password</label>
                                <input type="password" 
                                       name="password" 
                                       class="form-control form-control-lg rounded-3"
                                       placeholder="••••••••">
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 rounded-3 py-3 fw-medium">
                                MASUK
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <small class="text-muted">Belum punya akun? Hubungi Admin</small>
                        </div>
                    </div>
                </div>

                <!-- Optional Footer -->
                <div class="text-center mt-4 text-muted small">
                    &copy; {{ date('Y') }} POS System
                </div>

            </div>
        </div>
    </div>
</div>

@endsection