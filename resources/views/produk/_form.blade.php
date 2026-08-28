@csrf

<!-- Layout Upload & Preview Foto -->
<div class="row g-3 mb-3 align-items-center">
    @if (!empty($produk->foto))
        <div class="col-auto">
            <label class="form-label d-block" style="color: var(--text-secondary); font-weight: 600;">Foto Saat Ini</label>
            <img src="{{ asset('storage/' . $produk->foto) }}"
                 alt="Foto Produk"
                 width="120" height="120"
                 class="img-thumbnail object-fit-cover" 
                 style="border-radius: 12px;">
        </div>
    @endif

    <div class="col">
        <label for="foto" class="form-label" style="color: var(--text-secondary); font-weight: 600;">Pilih Gambar Produk</label>
        <input type="file" 
               name="foto" 
               id="foto"
               accept="image/*"
               onchange="previewImage(this)"
               class="form-control @error('foto') is-invalid @enderror">

        @error('foto')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-auto" id="preview-container" style="display: none;">
        <label class="form-label d-block" style="color: var(--text-secondary); font-weight: 600;">Preview Baru</label>
        <img id="preview" 
             width="120" height="120"
             class="img-thumbnail object-fit-cover" 
             style="border-radius: 12px;">
    </div>
</div>

<!-- Nama Produk -->
<div class="mb-3">
    <label for="name" class="form-label" style="color: var(--text-secondary); font-weight: 600;">Nama Produk <span class="text-danger">*</span></label>
    <input type="text" 
           name="name" 
           id="name"
           class="form-control @error('name') is-invalid @enderror @error('nama_produk') is-invalid @enderror"
           value="{{ old('name', $produk->nama ?? $produk->name ?? '') }}"
           placeholder="Masukkan nama produk"
           required>

    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('nama_produk')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Jenis Produk -->
<div class="mb-3">
    <label for="jenis_id" class="form-label" style="color: var(--text-secondary); font-weight: 600;">Jenis Produk <span class="text-danger">*</span></label>
    <select name="jenis_id" 
            id="jenis_id"
            class="form-select @error('jenis_id') is-invalid @enderror @error('jenis') is-invalid @enderror" 
            required>
        <option value="">-- Pilih Jenis --</option>
        
        @if(isset($jenis) && is_iterable($jenis))
            @foreach($jenis as $item)
                @if(is_object($item))
                    <option value="{{ $item->id }}" {{ old('jenis_id', $produk->jenis_id ?? '') == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_jenis ?? $item->nama }}
                    </option>
                @else
                    <option value="{{ $item }}" {{ old('jenis_id', $produk->jenis_id ?? '') == $item ? 'selected' : '' }}>
                        {{ $item }}
                    </option>
                @endif
            @endforeach
        @endif
    </select>

    @error('jenis_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('jenis')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Grid Harga Beli & Harga Jual -->
<div class="row g-3 mb-3">
    <div class="col-md-6">
        <label for="purchase_price" class="form-label" style="color: var(--text-secondary); font-weight: 600;">Harga Beli (Rp) <span class="text-danger">*</span></label>
        <input type="number" 
               name="purchase_price" 
               id="purchase_price"
               min="0"
               class="form-control @error('purchase_price') is-invalid @enderror @error('harga_beli') is-invalid @enderror"
               value="{{ old('purchase_price', $produk->harga_beli ?? $produk->purchase_price ?? '') }}"
               placeholder="0"
               required>

        @error('purchase_price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @error('harga_beli')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="selling_price" class="form-label" style="color: var(--text-secondary); font-weight: 600;">Harga Jual (Rp) <span class="text-danger">*</span></label>
        <input type="number" 
               name="selling_price" 
               id="selling_price"
               min="0"
               class="form-control @error('selling_price') is-invalid @enderror @error('harga_jual') is-invalid @enderror"
               value="{{ old('selling_price', $produk->harga_jual ?? $produk->selling_price ?? '') }}"
               placeholder="0"
               required>

        @error('selling_price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @error('harga_jual')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<!-- Stok -->
<div class="mb-4">
    <label for="stock" class="form-label" style="color: var(--text-secondary); font-weight: 600;">Stok <span class="text-danger">*</span></label>
    <input type="number" 
           name="stock" 
           id="stock"
           min="0"
           class="form-control @error('stock') is-invalid @enderror @error('stok') is-invalid @enderror"
           value="{{ old('stock', $produk->stok ?? $produk->stock ?? '0') }}"
           placeholder="0"
           required>

    @error('stock')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    @error('stok')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Tombol Aksi -->
<div class="d-flex gap-2 pt-2 border-top">
    <button class="btn" type="submit" style="background: var(--accent-primary, #6366f1); color: #fff; border-radius: 10px; font-weight: 600; padding: 0.55rem 1.4rem;">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('produk.index') }}" class="btn" style="background: var(--bg-page, #f3f4f6); color: var(--text-secondary, #4b5563); border: 1px solid var(--border-color, #e5e7eb); border-radius: 10px; font-weight: 600; padding: 0.55rem 1.4rem;">
        Batal
    </a>
</div>

<!-- JavaScript Preview Gambar -->
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const container = document.getElementById('preview-container');
        const file = input.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
        }
    }
</script>