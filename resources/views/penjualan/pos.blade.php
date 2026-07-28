@extends('layouts.app')

@section('title', 'POS')

@section('content')

{{-- ALERT ERROR --}}
@if (session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<h4 class="mb-3">Tambah dan Edit</h4>

<div class="row">

    {{-- ================= PRODUK ================= --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body" style="max-height:70vh; overflow:auto">

                {{-- SEARCH --}}
                <form method="GET" action="{{ route('penjualan.create') }}" class="mb-3">
                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control"
                           placeholder="Cari produk..."
                           onkeyup="this.form.submit()">
                </form>

                {{-- LIST PRODUK --}}
                @foreach ($products as $product)
                    <form method="POST"
                          action="{{ route('itempenjualan.store') }}"
                          class="row g-2 mb-2">
                        @csrf

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="col-7">
                            <button type="submit"
                                    class="btn btn-outline-primary w-100 text-start p-2
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                <div class="fw-semibold">{{ $product->nama }}</div>
                                <small class="text-muted">
                                    Rp {{ number_format($product->harga_jual) }}
                                </small>
                            </button>
                        </div>

                        <div class="col-3">
                            <input type="number"
                                   name="quantity"
                                   value="1"
                                   min="1"
                                   class="form-control">
                        </div>

                        <div class="col-2">
                            <button class="btn btn-primary w-100">+</button>
                        </div>
                    </form>
                @endforeach

            </div>
        </div>
    </div>

    {{-- ================= KERANJANG ================= --}}
    <div class="col-md-6">
        <div class="card">

            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th width="80">Jumlah</th>
                        <th>Subtotal</th>
                        <th width="70">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($sale->itemPenjualan as $item)
                        <tr>
                            <td>{{ $item->produk->nama }}</td>
                            <td>Rp {{ number_format($item->produk->harga_jual) }}</td>

                            <td>
                                <form method="POST"
                                      action="{{ route('itempenjualan.update', $item->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <input type="number"
                                           name="quantity"
                                           value="{{ $item->kuantitas }}"
                                           min="1"
                                           class="form-control form-control-sm">
                                </form>
                            </td>

                            <td>Rp {{ number_format($item->subtotal) }}</td>

                            <td>
                                @can('delete', $item)
                                    <form method="POST"
                                          action="{{ route('itempenjualan.destroy', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Keranjang kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- FOOTER --}}
            <div class="card-footer">
                <h5 class="mb-2">
                    Total: Rp {{ number_format($sale->total_pembayaran) }}
                </h5>

                {{-- CHECKOUT --}}
                <form method="POST"
                      action="{{ route('penjualan.update', $sale->id) }}"
                      onsubmit="return confirm('Yakin ingin checkout?')">
                    @csrf
                    @method('PUT')

                    <select name="payment_method" class="form-select mb-2" required>
                        <option value="">Pilih Pembayaran</option>
                        <option value="CASH">Cash</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <button class="btn btn-success w-100
                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        Checkout
                    </button>
                </form>

                {{-- BATAL --}}
                @can('delete', $sale)
                    <form method="POST"
                          action="{{ route('penjualan.destroy', $sale->id) }}"
                          onsubmit="return confirm('Yakin ingin membatalkan transaksi?')"
                          class="mt-2">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100">
                            Batalkan Transaksi
                        </button>
                    </form>
                @endcan
            </div>

        </div>
    </div>

</div>
@endsection