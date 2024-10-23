<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        "barang_id",
        "jumlah_barang",
        "total_harga",
    ] ;

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
