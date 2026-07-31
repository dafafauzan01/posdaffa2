@extends('layouts.app')

@section('title', 'Detail Produk - ' . $produk->nama)

@section('content')

<style>
    .page-wrapper {
        background-color: var(--bg-page);
        min-height: 100vh;
        padding: 2.5rem 0 5rem;
    }

    .main-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .card-modern {
        background: var(--bg-card);
        border-radius: 20px;
        border: 1px solid var(--border-color);
        box-shadow: 0 4px 20px -2px rgba(31, 41, 55, 0.06);
        overflow: hidden;
    }

    .product-detail-img-wrapper {
        width: 100%;
        max-height: 320px;
        border-radius: 16px;
        overflow: hidden;
        background-color: var(--bg-page);
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-detail-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .table-detail td, .table-detail th {
        padding: 0.9rem 0;
        vertical-align: middle;
    }

    .table-detail th {
        color: var(--text-muted);
        font-weight: 600;
        font-size: 0.9rem;
        width: 35%;
    }

    .table-detail td {
        color: var(--text-primary);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .badge-stock-danger {
        background-color: var(--accent-danger-soft);
        color: var(--accent-danger);
        border: 1px solid #fecaca;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.82rem;
    }

    .badge-stock-warning {
        background-color: var(--accent-warning-soft);
        color: var(--accent-warning);
        border: 1px solid #fde68a;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.82rem;
    }

    .badge-stock-success {
        background-color: var(--accent-success-soft);
        color: var(--accent-success);
        border: 1px solid #B7E4E6;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.82rem;
    }

    .btn-custom-secondary {
        background-color: var(--bg-card);
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 0.65rem 1.4rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-custom-secondary:hover {
        background-color: var(--bg-page);
        color: var(--text-primary);
        border-color: var(--border-color);
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
</style>

<div class="page-wrapper">
    <div class="main-container">

        <!-- Back & Title Bar -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold mb-1" style="color: var(--text-primary); letter-spacing: -0.02em;">
                    Detail Produk
                </h3>
                <p class="mb-0" style="color: var(--text-muted); font-size: 0.9rem;">
                    Informasi lengkap barang & riwayat pendaftaran
                </p>
            </div>
            <a href="{{ route('produk.index') }}" class="btn-custom-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Main Detail Card -->
        <div class="card-modern p-4 p-md-5">
            <div class="row g-4 align-items-start">

                {{-- Foto Produk Section --}}
                <div class="col-md-5">
                    <div class="product-detail-img-wrapper p-2">
                        @if($produk->foto)
                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}" class="product-detail-img">
                        @else
                            <div class="text-center p-4" style="color: var(--text-muted);">
                                <i class="bi bi-image fs-1 d-block mb-2"></i>
                                <span class="small fw-medium">Tidak ada foto produk</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Informasi Produk Section --}}
                <div class="col-md-7">
                    <h4 class="fw-bold mb-3" style="color: var(--text-primary);">
                        {{ $produk->nama }}
                    </h4>

                    <div class="table-responsive">
                        <table class="table table-borderless table-detail mb-3">
                            <tbody>
                                <tr class="border-bottom">
                                    <th>Jenis Produk</th>
                                    <td>
                                        @if($produk->jenis === 'Makanan')
                                            <span class="badge-stock-warning"><i class="bi bi-egg-fried me-1"></i>Makanan</span>
                                        @elseif($produk->jenis === 'Minuman')
                                            <span class="badge-stock-success"><i class="bi bi-cup-straw me-1"></i>Minuman</span>
                                        @else
                                            <span class="badge-stock-danger"><i class="bi bi-box-seam me-1"></i>{{ $produk->jenis ?? 'Lainnya' }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Harga Beli (Modal)</th>
                                    <td style="color: var(--text-secondary); font-weight: 600;">
                                        Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Harga Jual</th>
                                    <td class="fw-bold fs-5" style="color: var(--accent-primary-dark);">
                                        Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Margin Keuntungan</th>
                                    <td class="fw-bold" style="color: var(--accent-success);">
                                        Rp {{ number_format($produk->harga_jual - $produk->harga_beli, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Status Stok</th>
                                    <td>
                                        @if($produk->stok <= 5)
                                            <span class="badge-stock-danger">
                                                <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $produk->stok }} Unit (Sisa Sedikit)
                                            </span>
                                        @elseif($produk->stok <= 10)
                                            <span class="badge-stock-warning">
                                                <i class="bi bi-exclamation-circle-fill me-1"></i> {{ $produk->stok }} Unit Tersedia
                                            </span>
                                        @else
                                            <span class="badge-stock-success">
                                                <i class="bi bi-check-circle-fill me-1"></i> {{ $produk->stok }} Unit Tersedia
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Dibuat</th>
                                    <td class="fw-normal" style="color: var(--text-muted);">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        {{ $produk->created_at->format('d F Y') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    {{-- Actions --}}
                    @can('update', $produk)
                        <div class="d-flex gap-2 pt-2">
                            <a href="{{ route('produk.edit', $produk) }}" class="btn-gradient-primary">
                                <i class="bi bi-pencil-square"></i> Edit Data Produk
                            </a>
                        </div>
                    @endcan
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
