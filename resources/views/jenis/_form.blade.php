@csrf

<div class="mb-4">
    <label for="nama_jenis" class="form-label fw-semibold" style="color: #374151;">
        Nama Jenis Produk <span class="text-danger">*</span>
    </label>
    <input type="text" 
           name="nama_jenis" 
           id="nama_jenis"
           class="form-control @error('nama_jenis') is-invalid @enderror @error('nama') is-invalid @enderror" 
           value="{{ old('nama_jenis', $jenis->nama_jenis ?? $jenis->nama ?? '') }}" 
           placeholder="Contoh: Makanan, Minuman, Snacking, dll." 
           style="border-radius: 8px; padding: 0.6rem 0.9rem;"
           required 
           autofocus>

    @error('nama_jenis')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('nama')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Tombol Aksi -->
<div class="d-flex align-items-center justify-content-end gap-2 pt-3 border-top">
    <a href="{{ route('jenis.index') }}" class="btn px-4 py-2 fw-semibold" style="background-color: #f3f4f6; color: #4b5563; border-radius: 10px;">
        Batal
    </a>
    <button type="submit" class="btn text-white px-4 py-2 fw-semibold" style="background-color: #6366f1; border-radius: 10px;">
        <i class="bi bi-check-lg me-1"></i> Simpan Jenis
    </button>
</div>