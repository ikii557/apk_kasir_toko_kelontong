<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama_barang",
        "harga_barang",
        "jumblah_barang",
    ];

    public function Transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
