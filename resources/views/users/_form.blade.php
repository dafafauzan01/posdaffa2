@csrf

<div class="mb-3">
    <label class="form-label" style="color: var(--text-secondary); font-weight: 600;">Nama</label>
    <input type="text" name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $user->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" style="color: var(--text-secondary); font-weight: 600;">Email</label>
    <input type="email" name="email"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $user->email ?? '') }}">
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" style="color: var(--text-secondary); font-weight: 600;">Password</label>
    <input type="password" name="password"
           class="form-control @error('password') is-invalid @enderror">
    @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label" style="color: var(--text-secondary); font-weight: 600;">Role</label>
    <select name="role_id"
           class="form-select @error('role_id') is-invalid @enderror">
        <option value="">-- Pilih Role --</option>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}"
                @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="d-flex gap-2 mt-4">
    <button class="btn" style="background: var(--accent-primary); color: #fff; border-radius: 10px; font-weight: 600; padding: 0.55rem 1.4rem;">
        <i class="bi bi-check-lg me-1"></i> Simpan
    </button>
    <a href="{{ route('admin.users') }}" class="btn" style="background: var(--bg-page); color: var(--text-secondary); border: 1px solid var(--border-color); border-radius: 10px; font-weight: 600; padding: 0.55rem 1.4rem;">
        Kembali
    </a>
</div>
