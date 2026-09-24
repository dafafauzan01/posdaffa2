@extends('layouts.app')

@section('title', 'POS - Transaksi Penjualan')

@section('content')

<style>
    .page-wrapper {
        background-color: var(--bg-page);
        min-height: 100vh;
        padding: 2rem 0 4rem;
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
    .pos-search {
        border-radius: 12px;
        border: 1px solid var(--border-color);
        padding: 0.7rem 1rem;
    }
    .pos-search:focus {
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.12);
    }
    .product-pick-btn {
        border: 1px solid var(--border-color);
        background: var(--bg-card);
        color: var(--text-primary);
        border-radius: 12px;
        transition: all 0.15s ease;
    }
    .product-pick-btn:hover {
        border-color: var(--accent-primary);
        background: var(--accent-primary-soft);
    }
    .product-pick-btn .price-tag {
        color: var(--accent-primary-dark);
        font-weight: 600;
    }
    .qty-input {
        border-radius: 10px;
        border: 1px solid var(--border-color);
    }
    .btn-add {
        background: var(--accent-primary);
        color: #fff;
        border: none;
        border-radius: 10px;
        font-weight: 700;
    }
    .btn-add:hover { background: var(--accent-primary-dark); color: #fff; }

    .cart-table th {
        background: var(--bg-page);
        color: var(--text-muted);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        font-weight: 700;
        border-color: var(--border-color) !important;
    }
    .cart-table td {
        color: var(--text-primary);
        border-color: var(--border-color) !important;
        vertical-align: middle;
    }

    .pos-footer {
        background: var(--bg-page);
        border-top: 1px solid var(--border-color);
        padding: 1.25rem;
    }

    .btn-checkout {
        background: var(--accent-success);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        padding: 0.75rem;
    }
    .btn-checkout:hover { background: #0A5B63; color: #fff; }
    .btn-checkout.disabled, .btn-checkout:disabled { opacity: 0.6; cursor: not-allowed; }

    .btn-print {
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        padding: 0.75rem;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    .btn-print:hover { background: #1d4ed8; color: #fff; }

    .btn-cancel-outline {
        background: transparent;
        color: var(--accent-danger);
        border: 1px solid var(--accent-danger-soft);
        border-radius: 12px;
        font-weight: 600;
        padding: 0.6rem;
    }
    .btn-cancel-outline:hover {
        background: var(--accent-danger-soft);
    }

    .btn-remove-item {
        background: var(--accent-danger-soft);
        color: var(--accent-danger);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.82rem;
        padding: 0.35rem 0.7rem;
    }
    .btn-remove-item:hover { background: #fecaca; }
</style>

<div class="page-wrapper">
    <div class="main-container">

        {{-- ALERT ERROR --}}
        @if (session('errors'))
            <div class="alert alert-danger mb-3">
                {{ session('errors') }}
            </div>
        @endif

        <h4 class="fw-bold mb-3" style="color: var(--text-primary);">Transaksi Penjualan</h4>

        <div class="row g-3">

            {{-- ================= PRODUK ================= --}}
            <div class="col-md-6">
                <div class="card-modern">
                    <div class="p-3" style="max-height:70vh; overflow-y:auto">

                        {{-- SEARCH --}}
                        <form method="GET" action="{{ route('penjualan.create') }}" class="mb-3">
                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control pos-search"
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
                                            class="product-pick-btn btn w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}"
                                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                        <div class="fw-semibold">{{ $product->nama }}</div>
                                        <small class="price-tag">
                                            Rp {{ number_format($product->harga_jual) }}
                                        </small>
                                    </button>
                                </div>

                                <div class="col-3">
                                    <input type="number"
                                           name="quantity"
                                           value="1"
                                           min="1"
                                           class="form-control qty-input"
                                           {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                </div>

                                <div class="col-2">
                                    <button type="submit" class="btn btn-add w-100" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>+</button>
                                </div>
                            </form>
                        @endforeach

                    </div>
                </div>
            </div>
            

            {{-- ================= KERANJANG ================= --}}
            <div class="col-md-6">
                <div class="card-modern overflow-hidden">

                    <table class="table cart-table mb-0">
                        <thead>
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
                                    <td>{{ $item->produk?->nama ?? 'Produk Dihapus' }}</td>
                                    <td>Rp {{ number_format($item->produk?->harga_jual ?? 0) }}</td>

                                    <td>
                                        @if($sale->status === 'OPEN')
                                            <form method="POST"
                                                  action="{{ route('itempenjualan.update', $item->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <input type="number"
                                                       name="quantity"
                                                       value="{{ $item->kuantitas }}"
                                                       min="1"
                                                       class="form-control form-control-sm qty-input"
                                                       onchange="this.form.submit()">
                                            </form>
                                        @else
                                            <span>{{ $item->kuantitas }}</span>
                                        @endif
                                    </td>

                                    <td class="fw-semibold" style="color: var(--accent-primary-dark);">
                                        Rp {{ number_format($item->subtotal) }}
                                    </td>

                                    <td>
                                        @if($sale->status === 'OPEN')
                                            @can('delete', $item)
                                                <form method="POST"
                                                      action="{{ route('itempenjualan.destroy', $item->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-remove-item">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endcan
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4" style="color: var(--text-muted);">
                                        Keranjang kosong
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    

                    {{-- FOOTER --}}
                    <div class="pos-footer">
                        <h5 class="mb-3 fw-bold" style="color: var(--text-primary);">
                            Total: <span style="color: var(--accent-primary-dark);">Rp {{ number_format($sale->total_pembayaran) }}</span>
                        </h5>

                        {{-- CHECKOUT ATAU CETAK STRUK --}}
                        @if ($sale->status === 'COMPLETED')
                            @if($sale->payment_method === 'CASH')
                                <div class="alert alert-secondary p-2 mb-3">
                                    <small class="d-block">Bayar: <strong>Rp {{ number_format($sale->paid_amount ?? 0) }}</strong></small>
                                    <small class="d-block">Kembalian: <strong class="text-success">Rp {{ number_format(($sale->paid_amount ?? 0) - $sale->total_pembayaran) }}</strong></small>
                                </div>
                            @endif

                            <a href="{{ route('penjualan.print', $sale->id) }}" target="_blank" class="btn btn-print w-100">
                                🖨️ Cetak Struk Transaksi
                            </a>

                            <script>
                                window.open("{{ route('penjualan.print', $sale->id) }}", "_blank");
                            </script>
                        @else
                            <form method="POST"
                                  action="{{ route('penjualan.update', $sale->id) }}"
                                  onsubmit="return confirm('Yakin ingin checkout?')">
                                @csrf
                                @method('PUT')

                                <select name="payment_method" id="payment_method" class="form-select mb-2 qty-input" required onchange="toggleCashInput()">
                                    <option value="">Pilih Pembayaran</option>
                                    <option value="CASH">Cash</option>
                                    <option value="QRIS">QRIS</option>
                                </select>

                                {{-- FIELD DIBAYAR DAN KEMBALIAN --}}
                                <div id="cash-group" style="display: none;" class="mb-3 p-2 border rounded bg-light">
                                    <div class="mb-2">
                                        <label class="form-label small fw-bold text-secondary mb-1">Jumlah Bayar (Rp)</label>
                                        <input type="number" 
                                               name="paid_amount" 
                                               id="paid_amount" 
                                               class="form-control qty-input" 
                                               placeholder="Masukkan nominal bayar"
                                               min="{{ $sale->total_pembayaran }}" 
                                               oninput="calculateChange()">
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="small fw-bold text-secondary">Kembalian:</span>
                                        <span class="fw-bold text-success" id="change-text">Rp 0</span>
                                    </div>
                                </div>

                                <button type="submit" id="btn-submit-checkout" class="btn btn-checkout w-100" {{ $sale->itemPenjualan->isEmpty() ? 'disabled' : '' }}>
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
                                    <button type="submit" class="btn btn-cancel-outline w-100">
                                        Batalkan Transaksi
                                    </button>
                                </form>
                            @endcan
                        @endif

                            @if ($sale->status === 'OPEN')
                                <form method="POST"
                                      action="{{ route('penjualan.update', $sale->id) }}"
                                      class="mb-2">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group">
                                        <input type="number"
                                               name="diskon"
                                               class="form-control qty-input"
                                               placeholder="Diskon (%)"
                                               min="0"
                                               max="100"
                                               value="{{ $sale->diskon ?? 0 }}">
                                        <button type="submit" class="btn btn-outline-secondary">Terapkan</button>
                                    </div>
                                </form>
                            @endif
                            @if(($sale->diskon ?? 0) > 0)
                                <div class="alert alert-info p-2 mb-0">
                                    <small class="d-block">Diskon: <strong>{{ $sale->diskon }}%</strong></small>
                                </div>
                            @endif

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

{{-- SCRIPT HITUNG KEMBALIAN OTOMATIS --}}
<script>
    const totalPayment = {{ $sale->total_pembayaran ?? 0 }};

    function toggleCashInput() {
        const paymentMethod = document.getElementById('payment_method').value;
        const cashGroup = document.getElementById('cash-group');
        const paidAmountInput = document.getElementById('paid_amount');
        const btnSubmit = document.getElementById('btn-submit-checkout');

        if (paymentMethod === 'CASH') {
            cashGroup.style.display = 'block';
            paidAmountInput.setAttribute('required', 'required');
            calculateChange();
        } else {
            cashGroup.style.display = 'none';
            paidAmountInput.removeAttribute('required');
            btnSubmit.disabled = false;
        }
    }

    function calculateChange() {
        const paymentMethod = document.getElementById('payment_method').value;
        if (paymentMethod !== 'CASH') return;

        const paidAmount = parseFloat(document.getElementById('paid_amount').value) || 0;
        const changeText = document.getElementById('change-text');
        const btnSubmit = document.getElementById('btn-submit-checkout');

        const change = paidAmount - totalPayment;

        if (change >= 0) {
            changeText.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(change);
            changeText.className = 'fw-bold text-success';
            btnSubmit.disabled = false;
        } else {
            changeText.innerText = 'Uang Kurang (Rp ' + new Intl.NumberFormat('id-ID').format(Math.abs(change)) + ')';
            changeText.className = 'fw-bold text-danger';
            btnSubmit.disabled = true;
        }
    }
</script>
@endsection