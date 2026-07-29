@extends('layouts.app')

@section('title', 'Daftar Produk')

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
        padding: 1rem 1.25rem;
    }

    .custom-table td {
        padding: 1rem 1.25rem;
        color: #0f172a;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.92rem;
    }

    .custom-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Product Thumbnail */
    .product-img-wrapper {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Stock Badges */
    .badge-stock-danger {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-stock-warning {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fef3c7;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-stock-success {
        background-color: #f0fdf4;
        color: #16a34a;
        border: 1px solid #dcfce7;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
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

    /* Action Icon Buttons */
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
        background-color: #eff6ff;
        color: #2563eb;
    }
    .btn-action-view:hover {
        background-color: #dbeafe;
        color: #1d4ed8;
    }

    .btn-action-edit {
        background-color: #fef3c7;
        color: #b45309;
    }
    .btn-action-edit:hover {
        background-color: #fde68a;
        color: #92400e;
    }

    .btn-action-delete {
        background-color: #fef2f2;
        color: #dc2626;
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
                    Daftar Produk
                </h2>
                <p class="mb-0 text-muted" style="font-size: 0.92rem;">
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
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok Status</th>
                            <th class="text-end pe-4" style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td class="ps-4 text-muted fw-semibold" style="font-size: 0.88rem;">
                                    {{ $products->firstItem() + $loop->index }}
                                </td>
                                <td>
                                    <div class="product-img-wrapper">
                                        @if($product->foto)
                                            <img src="{{ asset('storage/' . $product->foto) }}" alt="{{ $product->nama }}" class="product-img">
                                        @else
                                            <i class="bi bi-image text-muted fs-5"></i>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold" style="color: #0f172a;">{{ $product->nama }}</div>
                                </td>
                                <td class="text-muted">
                                    Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                                </td>
                                <td class="fw-semibold text-primary">
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
                                        <!-- Detail Button -->
                                        <a href="{{ route('produk.show', $product->id) }}" class="btn-action-icon btn-action-view" title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <!-- Edit Button -->
                                        @can('update', $product)
                                            <a href="{{ route('produk.edit', $product) }}" class="btn-action-icon btn-action-edit" title="Edit Produk">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endcan

                                        <!-- Delete Button -->
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
                                <td colspan="7">
                                    <div class="empty-state">
                                        <i class="bi bi-box-seam fs-1 d-block mb-2 text-muted"></i>
                                        <span class="fw-medium">Belum ada data produk yang tersedia.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Footer -->
            @if($products->hasPages())
                <div class="p-3 border-top d-flex justify-content-center bg-white">
                    {{ $products->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

@endsection