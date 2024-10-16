<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    // Specify the correct table name if it differs from the default pluralized form
   

    protected $fillable = [
        'barang_id',
        'jml_barang',
        'total_harga',
        'metode_pembayaran',
    ];

    // Define the relationship with the Barang model
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
