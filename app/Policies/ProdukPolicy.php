<?php

namespace App\Policies;

use App\Models\Produk;
use App\Models\User;

class ProdukPolicy
{
    /**
     * Bypass semua proteksi dan izinkan semua aksi
     */
    public function before(User $user, $ability): ?bool
    {
        return true;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Produk $produk): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Produk $produk): bool
    {
        return true;
    }

    public function delete(User $user, Produk $produk): bool
    {
        return true;
    }

    public function restore(User $user, Produk $produk): bool
    {
        return true;
    }

    public function forceDelete(User $user, Produk $produk): bool
    {
        return true;
    }
}
