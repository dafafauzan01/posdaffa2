@extends('layouts.app')

@section('title', 'Tentang Aplikasi POS')

@section('content')

@include('layouts.navbar')

<style>

/* =====================================================
   GLOBAL
===================================================== */

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    min-height: 100vh;

    background:
        radial-gradient(
            circle at 12% 20%,
            rgba(255, 255, 255, 0.65),
            transparent 28%
        ),
        radial-gradient(
            circle at 90% 80%,
            rgba(255, 255, 255, 0.35),
            transparent 30%
        ),
        linear-gradient(
            135deg,
            #f3e8ff 0%,
            #e9d5ff 50%,
            #fae8ff 100%
        ) !important;
}


/* =====================================================
   MAIN PAGE
===================================================== */

.sugar-page {
    width: 100%;
    max-width: 1060px;
    margin: 0 auto;
    padding: 24px 18px 35px;
}


/* =====================================================
   HEADER
===================================================== */

.sugar-header {
    text-align: center;
    margin-bottom: 26px;
}

.sugar-title {
    margin: 0;
    color: #5b21b6;
    font-size: 27px;
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -0.4px;
}

.sugar-subtitle {
    margin: 4px 0 0;
    color: #7c3aed;
    font-size: 12px;
    line-height: 1.4;
}


/* =====================================================
   GENERAL CARD
===================================================== */

.sugar-card {
    background: rgba(255, 255, 255, 0.98);
    border: 1px solid #e9d5ff;
    border-radius: 11px;
    box-shadow: 0 8px 22px rgba(109, 40, 217, 0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}


/* =====================================================
   GRIDS
===================================================== */

.section-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 14px;
}

.full-card {
    padding: 20px 25px;
    margin-bottom: 14px;
}


/* =====================================================
   TITLES & TEXT
===================================================== */

.card-title {
    margin-bottom: 11px;
    color: #5b21b6;
    font-size: 14px;
    font-weight: 800;
    line-height: 1.3;
}

.about-text {
    margin: 0 0 11px;
    color: #6b21a8;
    font-size: 11px;
    line-height: 1.8;
}

.about-text strong {
    color: #4c1d95;
}

.custom-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.custom-list li {
    margin-bottom: 8px;
    color: #6b21a8;
    font-size: 11px;
    line-height: 1.6;
    position: relative;
    padding-left: 14px;
}

.custom-list li::before {
    content: "•";
    color: #7c3aed;
    font-weight: bold;
    position: absolute;
    left: 0;
}


/* =====================================================
   INFO BOX & DETAILS
===================================================== */

.info-box {
    padding: 13px 14px;
    margin-bottom: 9px;
    background: #ffffff;
    border: 1px solid #f3e8ff;
    border-radius: 8px;
}

.info-title {
    margin-bottom: 9px;
    color: #5b21b6;
    font-size: 12px;
    font-weight: 800;
}

.info-row {
    margin-bottom: 5px;
    color: #6b21a8;
    font-size: 9px;
    line-height: 1.5;
}

.info-row strong {
    color: #4c1d95;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 900px) {
    .section-grid {
        grid-template-columns: 1fr;
    }
}

</style>


<div class="sugar-page">

    {{-- HEADER --}}
    <div class="sugar-header">
        <h1 class="sugar-title">Nexus POS System</h1>
        <p class="sugar-subtitle">Aplikasi Kasir & Manajemen Toko Digital Modern</p>
    </div>

    {{-- DESKRIPSI APLIKASI --}}
    <div class="sugar-card full-card">
        <div class="card-title">Tentang Aplikasi POS</div>
        <p class="about-text">
            <strong>Nexus POS System</strong> adalah aplikasi Point of Sale (Kasir Digital) terintegrasi yang dirancang khusus untuk mempermudah transaksi penjualan, pencatatan stok barang, dan pemantauan laporan keuangan harian secara real-time.
        </p>
        <p class="about-text">
            Sistem ini dibuat responsif, cepat, dan mudah digunakan oleh kasir maupun pemilik usaha untuk meminimalisir kesalahan pencatatan transaksi manual.
        </p>
    </div>

    {{-- FITUR UTAMA & SPESIFIKASI KEBUTUHAN --}}
    <div class="section-grid">

        {{-- Fitur Aplikasi --}}
        <div class="sugar-card full-card">
            <div class="card-title">Fitur Unggulan POS</div>
            <ul class="custom-list">
                <li><strong>Transaksi Cepat:</strong> Proses checkout dan pencetakan struk transaksi yang instan.</li>
                <li><strong>Manajemen Stok:</strong> Pemantauan sisa produk secara otomatis setelah transaksi.</li>
                <li><strong>Laporan Keuangan:</strong> Rekap omzet harian, mingguan, dan bulanan.</li>
                <li><strong>Manajemen Kategori & Produk:</strong> Pengelolaan data barang dengan mudah.</li>
            </ul>
        </div>

        {{-- Teknologi yang Digunakan --}}
        <div class="sugar-card full-card">
            <div class="card-title">Spesifikasi Aplikasi</div>
            <div class="info-box">
                <div class="info-row"><strong>Versi Sistem:</strong> v1.0.0 (Release)</div>
                <div class="info-row"><strong>Framework Backend:</strong> Laravel 12</div>
                <div class="info-row"><strong>Database:</strong> MySQL</div>
                <div class="info-row"><strong>Frontend UI:</strong> Blade, HTML5, CSS3</div>
            </div>
        </div>

    </div>

</div>

@endsection