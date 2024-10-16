<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    use HasFactory;

    // Define the table name if it's different from the pluralized form of the model
    protected $table = 'transaksi'; // Optional if your table is named 'transaksis'

    // Mass assignable attributes
    protected $fillable = [
        'barang_id',          // Foreign key linking to Barang table
        'jml_barang',         // Quantity of items
        'total_harga',        // Total price for the transaction
        'metode_pembayaran',  // Payment method
    ];

    // Define the relationship with the Barang model
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
