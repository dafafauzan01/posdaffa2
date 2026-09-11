@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            {{-- Main Profile Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                
                {{-- Header Accent Background --}}
                <div class="profile-header-bg py-5 text-center position-relative">
                    <div class="position-absolute top-100 start-50 translate-middle">
                        {{-- Inisial Nama Saja --}}
                        <div class="profile-avatar-placeholder fw-bold rounded-circle d-flex align-items-center justify-content-center text-white fs-2 shadow p-1 border border-3 border-white" style="width: 96px; height: 96px;">
                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="card-body pt-5 pb-4 px-4 text-center mt-3">
                    <h3 class="fw-bold text-dark mb-1">{{ $user->name }}</h3>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>

                    @php
                        $isAdmin = (
                            strtolower($user->role ?? '') === 'admin' || 
                            ($user->is_admin ?? false) == true || 
                            ($user->role_id ?? null) == 1
                        );
                    @endphp

                    <span class="badge {{ $isAdmin ? 'bg-danger-subtle text-danger border border-danger-subtle' : 'bg-primary-subtle text-primary border border-primary-subtle' }} px-3 py-2 rounded-pill fw-semibold fs-7 mb-4">
                        <i class="bi {{ $isAdmin ? 'bi-shield-check' : 'bi-person-badge' }} me-1"></i>
                        {{ $isAdmin ? 'Administrator' : 'Kasir / Staff' }}
                    </span>

                    {{-- Detail Info Card List --}}
                    <div class="row g-3 text-start mb-4">
                        <div class="col-12">
                            <div class="p-3 profile-info-box rounded-3 d-flex align-items-center gap-3">
                                <div class="profile-info-icon p-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="bi bi-person fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small">Nama Lengkap</span>
                                    <strong class="text-dark">{{ $user->name }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 profile-info-box rounded-3 d-flex align-items-center gap-3">
                                <div class="profile-info-icon p-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="bi bi-envelope fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small">Alamat Email</span>
                                    <strong class="text-dark">{{ $user->email }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 profile-info-box rounded-3 d-flex align-items-center gap-3">
                                <div class="profile-info-icon p-2 rounded-3 shadow-sm d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="bi bi-calendar-check fs-5"></i>
                                </div>
                                <div>
                                    <span class="d-block text-muted small">Terdaftar Sejak</span>
                                    <strong class="text-dark">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary fw-semibold py-2 rounded-3">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    .profile-header-bg {
        background: linear-gradient(135deg, var(--sidebar-bg, #1e293b) 0%, var(--accent-primary, #3b82f6) 100%);
    }

    .profile-avatar-placeholder {
        background: var(--accent-primary, #3b82f6);
    }

    .profile-info-box {
        background-color: #f8fafc;
        border: 1px solid #f1f5f9;
    }

    .profile-info-icon {
        background-color: #ffffff;
        color: var(--accent-primary, #3b82f6);
    }
</style>
@endsection