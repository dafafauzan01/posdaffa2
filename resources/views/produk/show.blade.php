@extends('layouts.app')

@section('title', 'Detail Produk - ' . $produk->nama)

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .page-wrapper {
        background-color: #f8fafc;
        min-height: 100vh;
        padding: 2.5rem 0 5rem;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    .main-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* Card Modern Base Style */
    .card-modern {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px -2px rgba(148, 163, 184, 0.12);
        overflow: hidden;
    }

    /* Image Preview Box */
    .product-detail-img-wrapper {
        width: 100%;
        max-height: 320px;
        border-radius: 16px;
        overflow: hidden;
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-detail-img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* Detail Table Custom */
    .table-detail td, .table-detail th {
        padding: 0.9rem 0;
        vertical-align: middle;
    }

    .table-detail th {
        color: #64748b;
        font-weight: 600;
        font-size: 0.9rem;
        width: 35%;
    }

    .table-detail td {
        color: #0f172a;
        font-weight: 600;
        font-size: 0.95rem;
    }

    /* Stock Badges */
    .badge-stock-danger {
        background-color: #fef2f2;
        color: #dc2626;
        border: 1px solid #fee2e2;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.82rem;
    }

    .badge-stock-warning {
        background-color: #fffbeb;
        color: #d97706;
        border: 1px solid #fef3c7;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.82rem;
    }

    .badge-stock-success {
        background-color: #f0fdf4;
        color: #16a34a;
        border: 1px solid #dcfce7;
        padding: 0.35rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.82rem;
    }

    /* Buttons */
    .btn-custom-secondary {
        background-color: #ffffff;
        color: #475569;
        border: 1px solid #cbd5e1;
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
        background-color: #f8fafc;
        color: #0f172a;
        border-color: #94a3b8;
    }

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
        transform: translateY(-1px);
        color: #ffffff;
    }
</style>

<div class="page-wrapper">
    <div class="main-container">

        <!-- Back & Title Bar -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h3 class="fw-bold mb-1" style="color: #0f172a; letter-spacing: -0.02em;">
                    Detail Produk
                </h3>
                <p class="mb-0 text-muted" style="font-size: 0.9rem;">
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
                            <div class="text-center text-muted p-4">
                                <i class="bi bi-image fs-1 d-block mb-2"></i>
                                <span class="small fw-medium">Tidak ada foto produk</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Informasi Produk Section --}}
                <div class="col-md-7">
                    <h4 class="fw-bold mb-3" style="color: #0f172a;">
                        {{ $produk->nama }}
                    </h4>

                    <div class="table-responsive">
                        <table class="table table-borderless table-detail mb-3">
                            <tbody>
                                <tr class="border-bottom">
                                    <th>Harga Beli (Modal)</th>
                                    <td class="text-secondary">
                                        Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Harga Jual</th>
                                    <td class="text-primary fw-bold fs-5">
                                        Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th>Margin Keuntungan</th>
                                    <td class="text-success fw-bold">
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
                                    <td class="text-muted fw-normal">
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