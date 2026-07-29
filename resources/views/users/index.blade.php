@extends('layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

    .page-wrapper {
        background-color: #f8fafc;
        min-height: 100vh;
        padding: 2.5rem 0 5rem;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    .main-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* Card Modern Base Style */
    .card-modern {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px -2px rgba(148, 163, 184, 0.12);
    }

    /* Search Input Styling */
    .search-input {
        border-radius: 14px 0 0 14px !important;
        border: 1px solid #cbd5e1;
        border-right: none;
        padding: 0.75rem 1.25rem;
        font-size: 0.95rem;
    }

    .search-input:focus {
        border-color: #7c3aed;
        box-shadow: none;
    }

    .search-btn {
        border-radius: 0 14px 14px 0 !important;
        background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
        border: none;
        color: white;
        padding: 0 1.5rem;
        transition: all 0.2s ease;
    }

    .search-btn:hover {
        opacity: 0.9;
        color: white;
    }

    /* Table Styling */
    .custom-table {
        margin-bottom: 0;
    }

    .custom-table th {
        background-color: #f8fafc;
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e2e8f0;
        padding: 1rem 1.5rem;
    }

    .custom-table td {
        padding: 1.1rem 1.5rem;
        color: #0f172a;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }

    .custom-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Avatar Circle */
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: #f3e8ff;
        color: #7c3aed;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.95rem;
    }

    /* Buttons */
    .btn-gradient-primary {
        background: linear-gradient(135deg, #7c3aed 0%, #2563eb 100%);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1.4rem;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 4px 15px rgba(124, 58, 237, 0.25);
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-gradient-primary:hover {
        opacity: 0.95;
        transform: translateY(-2px);
        color: #ffffff;
    }

    .btn-action-edit {
        background-color: #fef3c7;
        color: #b45309;
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
        color: #92400e;
    }

    .btn-action-delete {
        background-color: #fef2f2;
        color: #dc2626;
        border: none;
        border-radius: 10px;
        padding: 0.45rem 0.85rem;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-action-delete:hover {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .empty-state {
        text-align: center;
        padding: 3.5rem 1rem;
        color: #64748b;
    }
</style>

<div class="page-wrapper">
    <div class="main-container">

        <!-- Top Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
            <div>
                <h2 class="fw-bold mb-1" style="color: #0f172a; font-size: 1.75rem; letter-spacing: -0.02em;">
                    Kelola Pengguna
                </h2>
                <p class="mb-0 text-muted" style="font-size: 0.92rem;">
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
                                <td class="ps-4 text-muted fw-semibold" style="font-size: 0.88rem;">
                                    {{ $users->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold" style="color: #0f172a;">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-muted">{{ $user->email }}</td>
                                <td>
                                    @php
                                        $roleName = strtolower($user->role->name ?? $user->role ?? '');
                                    @endphp

                                    @if($roleName == 'admin')
                                        <span class="badge rounded-pill px-3 py-2" style="background: #f3e8ff; color: #7c3aed; font-weight: 600; font-size: 0.78rem;">
                                            <i class="bi bi-shield-lock-fill me-1"></i> Admin
                                        </span>
                                    @elseif($roleName == 'staff' || $roleName == 'kasir')
                                        <span class="badge rounded-pill px-3 py-2" style="background: #eff6ff; color: #2563eb; font-weight: 600; font-size: 0.78rem;">
                                            <i class="bi bi-person-badge-fill me-1"></i> Staff / Kasir
                                        </span>
                                    @else
                                        <span class="badge rounded-pill px-3 py-2" style="background: #f1f5f9; color: #64748b; font-weight: 600; font-size: 0.78rem;">
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
                                        <i class="bi bi-people fs-1 d-block mb-2 text-muted"></i>
                                        <span class="fw-medium">Tidak ada data pengguna yang ditemukan.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            @if($users->hasPages())
                <div class="p-3 border-top d-flex justify-content-center bg-white">
                    {{ $users->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

@endsection