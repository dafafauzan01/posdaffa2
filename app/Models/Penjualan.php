<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    
    protected $fillable = [
        'user_id',
        'paid_amount',
        'diskon',
        'total_pembayaran',
        'metode_pembayaran',
        'status',   
    ];

    protected function casts(): array
    {
        return [
            'diskon' => 'integer',
            'paid_amount' => 'integer',
            'total_pembayaran' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }

   

}
