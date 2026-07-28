@extends('layouts.app')

@section('content')
<div class="container">

    <h4 class="mb-4">Detail Penjualan</h4>

    {{-- DATA TRANSAKSI --}}
    <div class="card mb-4">
        <div class="card-header">
            Informasi Transaksi
        </div>
        <div class="card-body">
            <table class="table table-sm table-borderless">
                <tr>
                    <th width="200">Kasir</th>
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
                        : <strong>Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ITEM PRODUK --}}
    <div class="card">
        <div class="card-header">
            Produk Yang Dibeli
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
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
                        <td colspan="5" class="text-center text-muted">
                            Tidak ada item penjualan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end">Total</th>
                        <th>
                            Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mt-3">
        Kembali
    </a>

</div>
@endsection