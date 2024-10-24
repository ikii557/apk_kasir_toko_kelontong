<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailTransaksiController extends Controller
{
    // Display form for creating a new transaction with detail
    public function create()
    {
        $barangs = Barang::all(); // Get all available items (barang)
        $transaksis = Transaksi::all(); // Get all transactions (if needed)
        return view('pages.transaksi.tambahtransaksi', compact('transaksis', 'barangs'));
    }

    // Store new detail transaction
    public function store(Request $request)
    {
        // Same logic as in TransaksiController to store details
        $request->validate([
            'no_transaksi'          => 'required',
            'tanggal_transaksi'     => 'required',
            'kasir'                 => 'required',
            'metode_pembayaran'     => 'required',
        ]);

        // Create the transaction
        $storeDetailTransaksi = [
            'no_transaksi'      => $request->no_transaksi,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'kasir'             => Auth::user()->id,
            'metode_pembayaran' => $request->metode_pembayaran,
        ];

        DetailTransaksi::create($storeDetailTransaksi);
        return redirect('/transaksi')->with('success', 'Detail transaksi berhasil disimpan.');
    }
}
