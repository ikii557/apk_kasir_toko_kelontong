<?php

namespace App\Models;

use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_barang",
        "stok_barang",
        "harga_barang",
    ];

    public function kurangiStok($jumlah_barang)
    {
        $this->stok_barang -= $jumlah_barang;


    $this->save();
    }

    public function DetailTransaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    
}
