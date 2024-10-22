<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->date('tanggal_transaksi');
            $table->string('kasir');
            $table->unsignedBigInteger('barang_id');
            $table->bigInteger('jumlah_barang');
            $table->string('total_harga');
            $table->enum('metode_pembayaran', ['tunai','debit','kredit']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
