@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')

<style>
    .page-wrapper {
        background-color: var(--bg-page);
        min-height: 100vh;
        padding: 2.5rem 0 5rem;
    }

    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .card-modern {
        background: var(--bg-card);
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 20px -2px rgba(31, 41, 55, 0.06);
    }

    .search-input {
        border-radius: 14px 0 0 14px !important;
        border: 1px solid var(--border-color);
        border-right: none;
        padding: 0.75rem 1.25rem;
        font-size: 0.95rem;
    }

    .search-input:focus {
        border-color: var(--accent-primary);
        box-shadow: none;
    }

    .search-btn {
        border-radius: 0 14px 14px 0 !important;
        background: var(--accent-primary);
        border: none;
        color: white;
        padding: 0 1.5rem;
        transition: all 0.2s ease;
    }

    .search-btn:hover {
        background: var(--accent-primary-dark);
        color: white;
    }

    .custom-table {
        margin-bottom: 0;
    }

    .custom-table th {
        background-color: var(--bg-page);
        color: var(--text-muted);
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 1.5rem;
    }

    .custom-table td {
        padding: 1.1rem 1.5rem;
        color: var(--text-primary);
        border-bottom: 1px solid var(--border-color);
        font-size: 0.95rem;
    }

    .custom-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: var(--bg-page);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: var(--accent-primary-soft);
        color: var(--accent-primary-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.95rem;
    }

    .btn-gradient-primary {
        background: var(--accent-primary);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1.4rem;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-gradient-primary:hover {
        background: var(--accent-primary-dark);
        color: #ffffff;
    }

    .btn-action-edit {
        background-color: var(--accent-warning-soft);
        color: #92400e;
        border: none;
        border-radius: 10px;
        padding: 0.45rem 0.85rem;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-action-edit:hover {
        background-color: #fde68a;
        color: #78350f;
    }

    .btn-action-delete {
        background-color: var(--accent-danger-soft);
        color: var(--accent-danger);
        border: none;
        border-radius: 10px;
        padding: 0.45rem 0.85rem;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-action-delete:hover {
        background-color: #fecaca;
        color: #991b1b;
    }

    .empty-state {
        text-align: center;
        padding: 3.5rem 1rem;
        color: var(--text-muted);
    }
</style>

<div class="page-wrapper">
    <div class="main-container">

        <!-- Top Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h2 class="fw-bold mb-1" style="color: var(--text-primary); font-size: 1.75rem; letter-spacing: -0.02em;">
                    Kelola Pengguna
                </h2>
                <p class="mb-0" style="color: var(--text-muted); font-size: 0.92rem;">
                    Atur akses akun administrator dan staff operasional
                </p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="btn-gradient-primary">
                <i class="bi bi-person-plus-fill fs-6"></i> Tambah User
            </a>
        </div>

        <!-- Search Bar -->
        <div class="card-modern p-3 mb-4">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control search-input"
                           placeholder="Cari berdasarkan nama atau alamat email...">
                    <button class="btn search-btn" type="submit">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="card-modern overflow-hidden">
            <div class="table-responsive">
                <table class="table custom-table align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4" style="width: 70px;">#</th>
                            <th>Pengguna</th>
                            <th>Email</th>
                            <th>Role / Akses</th>
                            <th class="text-end pe-4" style="width: 180px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="ps-4 fw-semibold" style="color: var(--text-muted); font-size: 0.88rem;">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold" style="color: var(--text-primary);">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td style="color: var(--text-muted);">{{ $user->email }}</td>
                                <td>
                                    @php
                                        $roleName = strtolower($user->role->name ?? $user->role ?? '');
                                    @endphp

                                    @if($roleName == 'admin')
                                        <span class="badge rounded-pill px-3 py-2" style="background: var(--accent-primary-soft); color: var(--accent-primary-dark); font-weight: 600; font-size: 0.78rem;">
                                            <i class="bi bi-shield-lock-fill me-1"></i> Admin
                                        </span>
                                    @elseif($roleName == 'staff' || $roleName == 'kasir')
                                        <span class="badge rounded-pill px-3 py-2" style="background: var(--accent-success-soft); color: var(--accent-success); font-weight: 600; font-size: 0.78rem;">
                                            <i class="bi bi-person-badge-fill me-1"></i> Staff / Kasir
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2" style="background: var(--bg-page); color: var(--text-muted); font-weight: 600; font-size: 0.78rem;">
                                            {{ ucfirst($user->role->name ?? $user->role) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('admin.users.edit', $user) }}" class="btn-action-edit" title="Edit User">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete" onclick="return confirm('Yakin ingin menghapus user ini?')" title="Hapus User">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <i class="bi bi-people fs-1 d-block mb-2"></i>
                                        <span class="fw-medium">Tidak ada data pengguna yang ditemukan.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="p-3 border-top d-flex justify-content-center bg-white">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

@endsection
