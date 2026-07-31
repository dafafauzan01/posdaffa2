@csrf

@if (!empty($produk->foto))
    <div class="mb-3">
        <label style="color: var(--text-secondary); font-weight: 600;">Foto Saat Ini:</label><br>
        <img src="{{ asset('storage/' . $produk->foto) }}"
             width="150"
             class="img-thumbnail" style="border-radius: 12px;">
    </div>
@endif

<div class="row">
    <div class="col">
        <div class="mb-3">
            <label style="color: var(--text-secondary); font-weight: 600;">Gambar</label>
            <input type="file" name="foto"
                onchange="previewImage(this)"
                class="form-control @error('foto') is-invalid @enderror">

            @error('foto')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col">
        <div class="mb-3">
            <label style="color: var(--text-secondary); font-weight: 600;">Preview Foto</label><br>
            <img id="preview" class="img-thumbnail mt-2" style="display:none; border-radius: 12px;" width="150">
        </div>
    </div>
</div>

<div class="mb-3">
    <label style="color: var(--text-secondary); font-weight: 600;">Nama Produk</label><br>
    <input type="text" name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $produk->nama ?? '') }}">

    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label style="color: var(--text-secondary); font-weight: 600;">Jenis Produk</label><br>
    <select name="jenis"
        class="form-control @error('jenis') is-invalid @enderror">
        <option value="">-- Pilih Jenis --</option>
        @foreach(['Makanan', 'Minuman', 'Lainnya'] as $jenisOption)
            <option value="{{ $jenisOption }}"
                {{ old('jenis', $produk->jenis ?? '') === $jenisOption ? 'selected' : '' }}>
                {{ $jenisOption }}
            </option>
        @endforeach
    </select>

    @error('jenis')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label style="color: var(--text-secondary); font-weight: 600;">Harga Beli</label><br>
    <input type="number" name="purchase_price"
        class="form-control @error('purchase_price') is-invalid @enderror"
        value="{{ old('purchase_price', $produk->harga_beli ?? '') }}">

    @error('purchase_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label style="color: var(--text-secondary); font-weight: 600;">Harga Jual</label><br>
    <input type="number" name="selling_price"
        class="form-control @error('selling_price') is-invalid @enderror"
        value="{{ old('selling_price', $produk->harga_jual ?? '') }}">

    @error('selling_price')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label style="color: var(--text-secondary); font-weight: 600;">Stok</label><br>
    <input type="number" name="stock"
        class="form-control @error('stock') is-invalid @enderror"
        value="{{ old('stock', $produk->stok ?? '') }}">

    @error('stock')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="d-flex gap-2 mt-4">
    <button class="btn" type="submit" style="background: var(--accent-primary); color: #fff; border-radius: 10px; font-weight: 600; padding: 0.55rem 1.4rem;">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('produk.index') }}" class="btn" style="background: var(--bg-page); color: var(--text-secondary); border: 1px solid var(--border-color); border-radius: 10px; font-weight: 600; padding: 0.55rem 1.4rem;">
        Kembali
    </a>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const file = input.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>
