@extends('layouts.app')

@section('title', 'Daftar Penjualan')

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
        padding: 1rem 1.25rem;
    }

    .custom-table td {
        padding: 1rem 1.25rem;
        color: var(--text-primary);
        border-bottom: 1px solid var(--border-color);
        font-size: 0.92rem;
    }

    .custom-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: var(--bg-page);
    }

    .badge-method {
        background-color: var(--bg-page);
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.78rem;
    }

    .badge-status-completed {
        background-color: var(--accent-success-soft);
        color: var(--accent-success);
        border: 1px solid #B7E4E6;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.78rem;
    }

    .badge-status-pending {
        background-color: var(--accent-warning-soft);
        color: var(--accent-warning);
        border: 1px solid #fde68a;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.78rem;
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

    .btn-action-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-action-view {
        background-color: var(--accent-primary-soft);
        color: var(--accent-primary-dark);
    }
    .btn-action-view:hover {
        background-color: #bfdbfe;
        color: var(--accent-primary-dark);
    }

    .btn-action-edit {
        background-color: var(--accent-warning-soft);
        color: #92400e;
    }
    .btn-action-edit:hover {
        background-color: #fde68a;
        color: #78350f;
    }

    .btn-action-delete {
        background-color: var(--accent-danger-soft);
        color: var(--accent-danger);
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
                    Daftar Penjualan
                </h2>
                <p class="mb-0" style="color: var(--text-muted); font-size: 0.92rem;">
                    Riwayat dan pemantauan transaksi penjualan
                </p>
            </div>
            <a href="{{ route('penjualan.create') }}" class="btn-gradient-primary">
                <i class="bi bi-plus-circle-fill fs-6"></i> Tambah Penjualan
            </a>
        </div>

        <!-- Alert Error -->
        @if(session('errors'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>{{ session('errors') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search Bar -->
        <div class="card-modern p-3 mb-4">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control search-input"
                           placeholder="Cari berdasarkan tanggal atau kasir...">
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
                            <th class="ps-4" style="width: 60px;">#</th>
                            <th>Tanggal Transaksi</th>
                            <th>Kasir</th>
                            <th>Total Pembayaran</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th class="text-end pe-4" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $sale)
                            <tr>
                                <td class="ps-4 fw-semibold" style="color: var(--text-muted); font-size: 0.88rem;">
                                    {{ $sales->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <div class="fw-medium" style="color: var(--text-primary);">
                                        <i class="bi bi-calendar-event me-1" style="color: var(--text-muted);"></i>
                                        {{ $sale->created_at->translatedFormat('d M Y H:i') }}
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.8rem; background: var(--bg-page); color: var(--text-secondary);">
                                            {{ strtoupper(substr($sale->user->name ?? 'K', 0, 1)) }}
                                        </div>
                                        <span class="fw-medium">{{ $sale->user->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="fw-bold" style="color: var(--accent-primary-dark);">
                                    Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge-method">
                                        <i class="bi bi-credit-card me-1"></i>{{ $sale->metode_pembayaran }}
                                    </span>
                                </td>
                                <td>
                                    @if($sale->status == 'COMPLETED')
                                        <span class="badge-status-completed">
                                            <i class="bi bi-check-circle-fill me-1"></i> {{ $sale->status }}
                                        </span>
                                    @else
                                        <span class="badge-status-pending">
                                            <i class="bi bi-clock-history me-1"></i> {{ $sale->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('penjualan.show', $sale) }}" class="btn-action-icon btn-action-view" title="Lihat Detail Nota">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        @can('update', $sale)
                                            <a href="{{ route('penjualan.edit', $sale) }}" class="btn-action-icon btn-action-edit" title="Edit Transaksi">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan

                                        @can('delete', $sale)
                                            <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-icon btn-action-delete" onclick="return confirm('Yakin ingin menghapus transaksi ini?')" title="Hapus Transaksi">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-receipt fs-1 d-block mb-2"></i>
                                        <span class="fw-medium">Belum ada riwayat transaksi penjualan.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($sales->hasPages())
                <div class="p-3 border-top d-flex justify-content-center bg-white">
                    {{ $sales->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

@endsection
