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
    .btn-custom-primary {
        background-color: var(--accent-primary, #2563eb);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 0.65rem 1.4rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-custom-primary:hover {
        background-color: var(--accent-primary-dark, #1d4ed8);
        color: #ffffff;
    }

    /* CSS KHUSUS PRINT STRUK THERMAL (Hanya aktif saat dialog print terbuka) */
    #printable-receipt {
        display: none;
    }

    @media print {
        body * {
            visibility: hidden;
        }
        #printable-receipt, #printable-receipt * {
            visibility: visible;
        }
        #printable-receipt {
            display: block !important;
            position: absolute;
            left: 0;
            top: 0;
            width: 80mm;
            padding: 10px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            color: #000;
            background: #fff;
        }
        #printable-receipt .text-center { text-align: center; }
        #printable-receipt .text-right { text-align: right; }
        #printable-receipt .dashed { border-bottom: 1px dashed #000; margin: 6px 0; }
        #printable-receipt table { width: 100%; border-collapse: collapse; }
        #printable-receipt td { padding: 2px 0; vertical-align: top; }
    }
</style>

<div class="page-wrapper">
    <div class="main-container">

        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="fw-bold mb-0" style="color: var(--text-primary);">Detail Penjualan</h4>
            
            {{-- TOMBOL PRINT --}}
            <button type="button" onclick="window.print()" class="btn-custom-primary">
                🖨️ Cetak Struk
            </button>
        </div>

        {{-- DATA TRANSAKSI --}}
        <div class="card-modern mb-4">
            <div class="card-modern-header">Informasi Transaksi</div>
            <div class="p-4">
                <table class="table table-sm table-borderless table-detail mb-0">
                    <tr>
                        <th>Kasir</th>
                        <td>: {{ $penjualan->user->name ?? 'Kasir' }}</td>
                    </tr>
                    <tr>
                        <th>Metode Pembayaran</th>
                        <td>: {{ $penjualan->payment_method ?? $penjualan->metode_pembayaran ?? 'CASH' }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: {{ ucfirst(strtolower($penjualan->status ?? 'COMPLETED')) }}</td>
                    </tr>
                    <tr>
                        <th>Total Pembayaran</th>
                        <td>
                            : <strong style="color: var(--accent-primary-dark, #2563eb);">Rp {{ number_format($penjualan->total_pembayaran ?? 0, 0, ',', '.') }}</strong>
                        </td>
                    </tr>
                    
                    {{-- DETAIL BAYAR DAN KEMBALIAN (KHUSUS CASH) --}}
                    @if(($penjualan->payment_method ?? $penjualan->metode_pembayaran ?? 'CASH') === 'CASH')
                    <tr>
                        <th>Tunai Diterima</th>
                        <td>: Rp {{ number_format($penjualan->paid_amount ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Kembalian</th>
                        <td>
                            : <strong class="text-success">
                                Rp {{ number_format(($penjualan->paid_amount ?? 0) - ($penjualan->total_pembayaran ?? 0), 0, ',', '.') }}
                            </strong>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>

        {{-- ITEM PRODUK --}}
        <div class="card-modern">
            <div class="card-modern-header">Produk Yang Dibeli</div>
            <div class="p-4 overflow-auto">
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
                            <td>{{ $item->produk?->nama ?? 'Produk Dihapus' }}</td>
                            <td>Rp {{ number_format($item->harga_satuan ?? $item->produk?->harga_jual ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $item->kuantitas }}</td>
                            <td>Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-3" style="color: var(--text-muted);">
                                Tidak ada item penjualan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Total</th>
                            <th style="color: var(--accent-primary-dark, #2563eb);">
                                Rp {{ number_format($penjualan->total_pembayaran ?? 0, 0, ',', '.') }}
                            </th>
                        </tr>
                        @if(($penjualan->payment_method ?? $penjualan->metode_pembayaran ?? 'CASH') === 'CASH')
                        <tr>
                            <th colspan="4" class="text-end">Bayar (Cash)</th>
                            <th>
                                Rp {{ number_format($penjualan->paid_amount ?? 0, 0, ',', '.') }}
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4" class="text-end">Kembalian</th>
                            <th class="text-success">
                                Rp {{ number_format(($penjualan->paid_amount ?? 0) - ($penjualan->total_pembayaran ?? 0), 0, ',', '.') }}
                            </th>
                        </tr>
                        @endif
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">
            <a href="{{ route('penjualan.index') }}" class="btn-custom-secondary">
                ← Kembali
            </a>

            <button type="button" onclick="window.print()" class="btn-custom-primary">
                🖨️ Cetak Struk
            </button>
        </div>

    </div>
</div>

{{-- AREA STRUK UNTUK MESIN PRINTER THERMAL --}}
<div id="printable-receipt">
    <div class="text-center">
        <strong style="font-size: 14px;">POS STORE</strong><br>
        Struk Pembayaran
    </div>

    <div class="dashed"></div>

    <table>
        <tr>
            <td>No. Transaksi</td>
            <td class="text-right">#{{ $penjualan->id }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td class="text-right">{{ $penjualan->created_at ? $penjualan->created_at->format('d/m/Y H:i') : date('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td class="text-right">{{ $penjualan->user->name ?? 'Kasir' }}</td>
        </tr>
    </table>

    <div class="dashed"></div>

    <table>
        @foreach($penjualan->itemPenjualan as $item)
        <tr>
            <td colspan="2"><strong>{{ $item->produk?->nama ?? 'Produk Dihapus' }}</strong></td>
        </tr>
        <tr>
            <td>{{ $item->kuantitas }} x Rp {{ number_format($item->harga_satuan ?? $item->produk?->harga_jual ?? 0, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <div class="dashed"></div>

    <table>
        <tr>
            <td><strong>TOTAL</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($penjualan->total_pembayaran ?? 0, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Metode Bayar</td>
            <td class="text-right">{{ $penjualan->payment_method ?? $penjualan->metode_pembayaran ?? 'CASH' }}</td>
        </tr>
        @if(($penjualan->payment_method ?? $penjualan->metode_pembayaran ?? 'CASH') === 'CASH')
        <tr>
            <td>BAYAR</td>
            <td class="text-right">Rp {{ number_format($penjualan->paid_amount ?? 0, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>KEMBALI</td>
            <td class="text-right">Rp {{ number_format(($penjualan->paid_amount ?? 0) - ($penjualan->total_pembayaran ?? 0), 0, ',', '.') }}</td>
        </tr>
        @endif
    </table>

    <div class="dashed"></div>

    <div class="text-center" style="margin-top: 10px;">
        Terima kasih atas kunjungan Anda!
    </div>
</div>

@endsection