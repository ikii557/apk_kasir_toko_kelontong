<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tanggal_transaksi',
        'user_id',
        'metode_pembayaran',
    ];

    // Relationship with DetailTransaksi model
    public function detailtransaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    // Relationship with User model for the cashier
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
