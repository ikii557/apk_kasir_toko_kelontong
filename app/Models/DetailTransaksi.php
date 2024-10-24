<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table='detailtransaksis';
    protected $fillable = [
        'transaksi_id',
        'barang_id',
        'jumlah_barang',
        'total_harga',
    ];

    // Relationship to Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    // Relationship to Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
