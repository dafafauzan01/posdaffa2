@extends('layouts.app')

@section('title', 'Detail Penjualan')

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
    .card-modern-header {
        background: var(--bg-page);
        border-bottom: 1px solid var(--border-color);
        padding: 1rem 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
    }
    .table-detail th {
        color: var(--text-muted);
        font-weight: 600;
        width: 200px;
    }
    .table-detail td {
        color: var(--text-primary);
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
    }
</style>

<div class="page-wrapper">
    <div class="main-container">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="fw-bold mb-0" style="color: var(--text-primary);">Detail Penjualan</h4>
        </div>

        {{-- DATA TRANSAKSI --}}
        <div class="card-modern mb-4">
            <div class="card-modern-header">Informasi Transaksi</div>
            <div class="p-4">
                <table class="table table-sm table-borderless table-detail mb-0">
                    <tr>
                        <th>Kasir</th>
                        <td>: {{ $penjualan->user->name }}</td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>: {{ $penjualan->metode_pembayaran }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: {{ ucfirst($penjualan->status) }}</td>
                    </tr>
                    <tr>
                        <th>Total Pembayaran</th>
                        <td>
                            : <strong style="color: var(--accent-primary-dark);">Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- ITEM PRODUK --}}
        <div class="card-modern">
            <div class="card-modern-header">Produk Yang Dibeli</div>
            <div class="p-4">
                <table class="table table-bordered mb-0" style="border-color: var(--border-color);">
                    <thead>
                        <tr style="background: var(--bg-page); color: var(--text-muted);">
                            <th width="50">No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penjualan->itemPenjualan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->produk->nama }}</td>
                            <td>Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td>{{ $item->kuantitas }}</td>
                            <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center" style="color: var(--text-muted);">
                                Tidak ada item penjualan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total</th>
                            <th style="color: var(--accent-primary-dark);">
                                Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <a href="{{ route('penjualan.index') }}" class="btn-custom-secondary mt-3">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

    </div>
</div>
@endsection
