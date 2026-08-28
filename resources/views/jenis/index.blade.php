@extends('layouts.app')

@section('title', 'Daftar Jenis Produk')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <!-- Header & Action Button -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold m-0" style="color: #1f2937;">Daftar Jenis Produk</h4>
            <span class="text-muted small">Kelola kategori dan jenis barang toko Anda</span>
        </div>
        <a href="{{ route('jenis.create') }}" class="btn text-white px-3 py-2 fw-semibold" style="background-color: #6366f1; border-radius: 10px;">
            <i class="bi bi-plus-lg me-1"></i> Tambah Jenis
        </a>
    </div>

    <!-- Alert Notifikasi -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 mb-4 shadow-sm" role="alert" style="background-color: #d1fae5; color: #065f46;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Table -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden" style="background: #ffffff;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                    <tr>
                        <th class="py-3 px-4 text-secondary text-uppercase small fw-bold" width="80">No</th>
                        <th class="py-3 px-4 text-secondary text-uppercase small fw-bold">Nama Jenis</th>
                        <th class="py-3 px-4 text-secondary text-uppercase small fw-bold text-center" width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenis as $index => $item)
                        <tr style="border-bottom: 1px solid #f1f5f9;">
                            <td class="py-3 px-4 text-muted fw-semibold">
                                {{ method_exists($jenis, 'firstItem') ? $jenis->firstItem() + $index : $loop->iteration }}
                            </td>
                            <td class="py-3 px-4 fw-semibold" style="color: #334155;">
                                {{ $item->nama_jenis ?? $item->nama }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('jenis.edit', $item->id) }}" class="btn btn-sm btn-warning text-white rounded-2 px-3 fw-medium">
                                        Edit
                                    </a>
                                    <form action="{{ route('jenis.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jenis ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger rounded-2 px-3 fw-medium">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox display-6 d-block mb-2 text-secondary"></i>
                                Belum ada data jenis produk. Silakan tambah jenis baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(method_exists($jenis, 'hasPages') && $jenis->hasPages())
            <div class="px-4 py-3 border-top">
                {{ $jenis->links() }}
            </div>
        @endif
    </div>
</div>
@endsection