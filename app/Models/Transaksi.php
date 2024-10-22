<?php

namespace App\Models;

use App\Models\Barang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tanggal_transaksi',
        'barang_id',
        'jumlah_barang',
        'total_harga',
        'metode_pembayaran',
    ];

    // Define the relationship with the Barang model
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
