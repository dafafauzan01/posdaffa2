@extends('layouts.app')

@section('title', 'Daftar Produk')

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

    .product-img-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        background-color: var(--bg-page);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .badge-stock-danger {
        background-color: var(--accent-danger-soft);
        color: var(--accent-danger);
        border: 1px solid #fecaca;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-stock-warning {
        background-color: var(--accent-warning-soft);
        color: var(--accent-warning);
        border: 1px solid #fde68a;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-stock-success {
        background-color: var(--accent-success-soft);
        color: var(--accent-success);
        border: 1px solid #B7E4E6;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
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
                    Daftar Produk
                </h2>
                <p class="mb-0" style="color: var(--text-muted); font-size: 0.92rem;">
                    Kelola ketersediaan barang, stok, dan harga jual
                </p>
            </div>
            @can('create', App\Models\Produk::class)
                <a href="{{ route('produk.create') }}" class="btn-gradient-primary">
                    <i class="bi bi-plus-circle-fill fs-6"></i> Tambah Produk
                </a>
            @endcan
        </div>

        <!-- Search Bar -->
        <div class="card-modern p-3 mb-4">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="input-group">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control search-input"
                           placeholder="Cari nama produk...">
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
                            <th style="width: 80px;">Foto</th>
                            <th>Nama Produk</th>
                            <th>Jenis</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok Status</th>
                            <th class="text-end pe-4" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="ps-4 fw-semibold" style="color: var(--text-muted); font-size: 0.88rem;">
                                    {{ $products->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <div class="product-img-wrapper">
                                        @if($product->foto)
                                            <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="product-img">
                                        @else
                                            <i class="bi bi-image" style="color: var(--text-muted); font-size: 1.2rem;"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold" style="color: var(--text-primary);">{{ $product->nama }}</div>
                                </td>
                                <td>
                                    @if($product->jenis === 'Makanan')
                                        <span class="badge-stock-warning"><i class="bi bi-egg-fried me-1"></i>Makanan</span>
                                    @elseif($product->jenis === 'Minuman')
                                        <span class="badge-stock-success"><i class="bi bi-cup-straw me-1"></i>Minuman</span>
                                    @else
                                        <span class="badge-stock-danger"><i class="bi bi-box-seam me-1"></i>{{ $product->jenis ?? 'Lainnya' }}</span>
                                    @endif
                                </td>
                                <td style="color: var(--text-muted);">
                                    Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                                </td>
                                <td class="fw-semibold" style="color: var(--accent-primary-dark);">
                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                </td>
                                <td>
                                    @if($product->stok <= 5)
                                        <span class="badge-stock-danger">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $product->stok }} Sisa
                                        </span>
                                    @elseif($product->stok <= 10)
                                        <span class="badge-stock-warning">
                                            <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $product->stok }} Tersedia
                                        </span>
                                    @else
                                        <span class="badge-stock-success">
                                            <i class="bi bi-check-circle-fill me-1"></i> {{ $product->stok }} Tersedia
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ route('produk.show', $product->id) }}" class="btn-action-icon btn-action-view" title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        @can('update', $product)
                                            <a href="{{ route('produk.edit', $product) }}" class="btn-action-icon btn-action-edit" title="Edit Produk">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan

                                        @can('delete', $product)
                                            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-icon btn-action-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')" title="Hapus Produk">
                                                    <i class="bi bi-trash3-fill"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                                        <span class="fw-medium">Belum ada data produk yang tersedia.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="p-3 border-top d-flex justify-content-center bg-white">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

@endsection
