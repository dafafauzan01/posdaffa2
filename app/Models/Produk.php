<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'user_id',
        'foto',
        'jenis_id',
        'nama',
        'harga_beli',
        'harga_jual',
        'stok'
    ];

    // Relasi ke User (pembuat/pemilik)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke Jenis Produk (Wajib ada agar nama jenis bisa muncul di daftar produk)
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }

    // Relasi ke Item Penjualan
    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'produk_id');
    }
}