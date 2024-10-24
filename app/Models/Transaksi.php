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
        'kasir',
        'metode_pembayaran',
    ];

    // Define the relationship with the Barang model
   public function detailtransaksi(){
    return $this->hasMany(DetailTransaksi::class);
   }

    public function user()
    {
        return $this->belongsTo(User::class, 'kasir');
    }
}
