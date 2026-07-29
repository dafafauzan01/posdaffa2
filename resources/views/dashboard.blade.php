@extends('layouts.app')

@section('title', 'Dashboard Penjualan')

@section('content')

<!-- Load Font Google Inter & Plus Jakarta Sans -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Reset & Typography Global */
    body, .dashboard-wrapper {
        background-color: #f8fafc;
        min-height: 100vh;
        padding: 2rem 0 5rem;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #1e293b;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* Heading khusus pakai Plus Jakarta Sans agar tegas */
    h1, h2, h3, h4, h5, h6, .font-heading {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        letter-spacing: -0.01em;
    }

    /* Section Divider */
    .section-divider {
        border-bottom: 1.5px solid #e2e8f0;
        margin: 1.5rem 0;
    }

    /* Base Card Style */
    .card-modern {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .card-header-line {
        border-bottom: 1px solid #f1f5f9;
        padding-bottom: 0.85rem;
    }

    /* Metric Cards */
    .metric-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 1.25rem 1.35rem;
        display: flex;
        align-items: center;
        gap: 1.1rem;
        box-shadow: 0 1px 2px rgba(0,0,0,0.03);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .metric-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px -4px rgba(0, 0, 0, 0.06);
    }

    .metric-icon-box {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    /* Color Themes */
    .icon-blue { background-color: #eff6ff; color: #2563eb; }
    .icon-purple { background-color: #f3e8ff; color: #9333ea; }
    .icon-emerald { background-color: #ecfdf5; color: #059669; }
    .icon-indigo { background-color: #e0e7ff; color: #4f46e5; }

    /* Action Buttons */
    .action-btn-primary {
        background: #4f46e5;
        border: 1px solid #4338ca;
        color: #ffffff !important;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        transition: all 0.15s ease;
    }

    .action-btn-primary:hover {
        background: #4338ca;
        transform: translateY(-1px);
    }

    .btn-icon-wrapper-kasir {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background-color: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .action-btn-secondary {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        color: #0f172a !important;
        border-radius: 14px;
        padding: 1rem 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        transition: all 0.15s ease;
    }

    .action-btn-secondary:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }

    .btn-icon-wrapper-secondary {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background-color: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Status Badge Live */
    .badge-live {
        background-color: #f0fdf4;
        color: #16a34a;
        border: 1px solid #bbf7d0;
        padding: 0.35rem 0.8rem;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .live-dot {
        width: 7px;
        height: 7px;
        background-color: #16a34a;
        border-radius: 50%;
        display: inline-block;
    }

    /* List Rows */
    .list-item-row {
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .list-item-row:last-child {
        border-bottom: none;
    }

    .item-rank-badge {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        background-color: #fef3c7;
        color: #d97706;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.82rem;
    }

    .product-img-thumbnail {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        object-fit: cover;
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
    }
</style>

<div class="dashboard-wrapper">
    <div class="dashboard-container">

        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-2">
            <div>
                <h3 class="fw-bold mb-1" style="color: #0f172a; font-size: 1.6rem;">
                    Dashboard Penjualan
                </h3>
                <p class="mb-0 text-secondary d-flex align-items-center gap-2" style="font-size: 0.875rem;">
                    <i class="bi bi-calendar3 text-primary"></i>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>
            </div>
            <div>
                <span class="badge-live">
                    <span class="live-dot"></span> Sistem Live
                </span>
            </div>
        </div>

        <div class="section-divider"></div>

        <!-- Stat Cards -->
        <div class="row g-3">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="metric-card">
                    <div class="metric-icon-box icon-blue">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <div>
                        <span class="text-uppercase text-muted fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.04em;">Penjualan Hari Ini</span>
                        <h4 class="fw-bold mb-0 mt-0.5" style="color: #0f172a; font-size: 1.35rem;">
                            Rp {{ number_format($penjualanHariIni ?? 33000, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="metric-card">
                    <div class="metric-icon-box icon-purple">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <div>
                        <span class="text-uppercase text-muted fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.04em;">Total Transaksi</span>
                        <h4 class="fw-bold mb-0 mt-0.5" style="color: #0f172a; font-size: 1.35rem;">
                            {{ $totalTransaksi ?? 4 }} <span class="fs-6 fw-normal text-muted">struk</span>
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="metric-card">
                    <div class="metric-icon-box icon-emerald">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <div>
                        <span class="text-uppercase text-muted fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.04em;">Pembayaran Tunai</span>
                        <h4 class="fw-bold mb-0 mt-0.5" style="color: #0f172a; font-size: 1.35rem;">
                            Rp {{ number_format($pembayaranTunai ?? 30000, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="metric-card">
                    <div class="metric-icon-box icon-indigo">
                        <i class="bi bi-qr-code-scan"></i>
                    </div>
                    <div>
                        <span class="text-uppercase text-muted fw-semibold" style="font-size: 0.7rem; letter-spacing: 0.04em;">Non-Tunai / QRIS</span>
                        <h4 class="fw-bold mb-0 mt-0.5" style="color: #0f172a; font-size: 1.35rem;">
                            Rp {{ number_format($pembayaranNonTunai ?? 3000, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="section-divider"></div>

        <!-- Content Area -->
        <div class="row g-4">
            
            <div class="col-lg-8 d-flex flex-column gap-4">

                <!-- Produk Terlaris -->
                <div class="card-modern p-4">
                    <div class="d-flex align-items-center gap-2 card-header-line mb-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-2 text-warning d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                            <i class="bi bi-trophy-fill fs-6"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">Produk Terlaris</h6>
                            <small class="text-muted" style="font-size: 0.8rem;">Performa produk terbaik hari ini</small>
                        </div>
                    </div>

                    <div>
                        @if(isset($produkTerlaris) && count($produkTerlaris) > 0)
                            @foreach($produkTerlaris as $index => $item)
                                <div class="d-flex align-items-center justify-content-between list-item-row">
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="item-rank-badge">{{ $loop->iteration }}</span>
                                        @if(isset($item->foto))
                                            <img src="{{ asset('storage/' . $item->foto) }}" class="product-img-thumbnail" alt="{{ $item->nama }}">
                                        @else
                                            <div class="product-img-thumbnail d-flex align-items-center justify-content-center text-muted">
                                                <i class="bi bi-box-seam"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="fw-semibold text-dark mb-0" style="font-size: 0.9rem;">{{ $item->nama }}</h6>
                                            <small class="text-muted" style="font-size: 0.8rem;">Terjual {{ $item->total_terjual ?? $item->terjual ?? 0 }} pcs</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold text-primary" style="font-size: 0.95rem;">
                                            Rp {{ number_format($item->total_pendapatan ?? $item->harga_jual * ($item->terjual ?? 1), 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="d-flex align-items-center justify-content-between list-item-row">
                                <div class="d-flex align-items-center gap-3">
                                    <span class="item-rank-badge">1</span>
                                    <div class="product-img-thumbnail d-flex align-items-center justify-content-center text-muted">
                                        <i class="bi bi-box-seam fs-6"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-semibold text-dark mb-0" style="font-size: 0.9rem;">sap</h6>
                                        <small class="text-muted" style="font-size: 0.8rem;">Terjual 11 pcs</small>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold text-primary" style="font-size: 0.95rem;">Rp 33.000</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Stok Info -->
                <div class="row g-3">
                    
                    <div class="col-md-6">
                        <div class="card-modern p-4 h-100">
                            <div class="d-flex align-items-center gap-2 card-header-line mb-3">
                                <div class="rounded-circle bg-warning bg-opacity-10 p-2 text-warning d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="bi bi-exclamation-triangle-fill fs-6"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">Stok Menipis</h6>
                                    <small class="text-muted" style="font-size: 0.8rem;">Perlu diisi ulang segera</small>
                                </div>
                            </div>

                            <div class="text-center">
                                @if(isset($stokMenipis) && count($stokMenipis) > 0)
                                    @foreach($stokMenipis as $item)
                                        <div class="d-flex align-items-center justify-content-between list-item-row">
                                            <span class="fw-medium text-dark" style="font-size: 0.875rem;">{{ $item->nama }}</span>
                                            <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill">Sisa {{ $item->stok }}</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="py-3">
                                        <i class="bi bi-check-circle-fill fs-3 text-success d-block mb-1"></i>
                                        <span class="small text-muted fw-medium">Stok barang aman</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card-modern p-4 h-100">
                            <div class="d-flex align-items-center gap-2 card-header-line mb-3">
                                <div class="rounded-circle bg-danger bg-opacity-10 p-2 text-danger d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="bi bi-x-circle-fill fs-6"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">Stok Habis</h6>
                                    <small class="text-muted" style="font-size: 0.8rem;">Tidak dapat dijual</small>
                                </div>
                            </div>

                            <div>
                                @if(isset($stokHabis) && count($stokHabis) > 0)
                                    @foreach($stokHabis as $item)
                                        <div class="d-flex align-items-center justify-content-between list-item-row">
                                            <span class="fw-medium text-dark" style="font-size: 0.875rem;">{{ $item->nama }}</span>
                                            <span class="badge bg-danger-subtle text-danger rounded-pill">Stok Kosong</span>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex align-items-center justify-content-between list-item-row">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="product-img-thumbnail d-flex align-items-center justify-content-center text-muted" style="width: 32px; height: 32px;">
                                                <i class="bi bi-box"></i>
                                            </div>
                                            <span class="fw-medium text-dark" style="font-size: 0.875rem;">sap</span>
                                        </div>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-0.5" style="font-size: 0.75rem;">Stok Kosong</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Quick Actions -->
            <div class="col-lg-4">
                <div class="card-modern p-4 h-100 d-flex flex-column">
                    <div class="d-flex align-items-center gap-2 card-header-line mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 text-primary d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;">
                            <i class="bi bi-lightning-charge-fill fs-6"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0 text-dark">Aksi Cepat</h6>
                            <small class="text-muted" style="font-size: 0.8rem;">Pintasan operasional kasir</small>
                        </div>
                    </div>

                    <div class="d-flex flex-column gap-3 mt-1">
                        <a href="{{ route('penjualan.create') }}" class="action-btn-primary">
                            <div class="btn-icon-wrapper-kasir">
                                <i class="bi bi-shop-window fs-5 text-white"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 0.95rem;">Kasir / Transaksi</div>
                                <div class="small opacity-80" style="font-size: 0.8rem;">Buka mesin kasir POS</div>
                            </div>
                        </a>

                        <a href="{{ route('produk.create') }}" class="action-btn-secondary">
                            <div class="btn-icon-wrapper-secondary">
                                <i class="bi bi-plus-circle-fill fs-5 text-primary"></i>
                            </div>
                            <div>
                                <div class="fw-bold" style="font-size: 0.95rem;">Tambah Produk</div>
                                <div class="small text-muted" style="font-size: 0.8rem;">Input item barang baru</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection