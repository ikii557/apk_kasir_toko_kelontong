<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Display all transactions
    public function index(){
        $transaksis = Transaksi::all();
        return view("pages.transaksi.transaksi", compact("transaksis"));
    }

    // Show form to create new transaction
    public function create(){
        $barangs = Barang::all(); // Load all available items for selection
        return view('pages.transaksi.tambahtransaksi', compact('barangs'));
    }

    // Store new transaction in database
    public function store(Request $request){
        $request->validate([
            "barang_id" => "required|exists:barang,id", // Make sure the selected item exists
            "jumlah_barang" => "required|numeric",
            "total_harga" => "required|numeric",
            "metode_pembayaran" => "required",
        ]);

        Transaksi::create([
            "barang_id" => $request->barang_id,
            "jumlah_barang" => $request->jumlah_barang,
            "total_harga" => $request->total_harga,
            "metode_pembayaran" => $request->metode_pembayaran,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    // Show form to edit a transaction
    public function edit($id){
        $transaksi = Transaksi::findOrFail($id);
        $barangs = Barang::all(); // Load all available items for selection
        return view('pages.transaksi.edit', compact('transaksi', 'barangs'));
    }

    // Update transaction in database
    public function update(Request $request, $id){
        $request->validate([
            "barang_id" => "required|exists:barang,id",
            "jumlah_barang" => "required",
            "total_harga" => "required|numeric",
            "metode_pembayaran" => "required",
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            "barang_id" => $request->barang_id,
            "jumlah_barang" => $request->jumlah_barang,
            "total_harga" => $request->total_harga,
            "metode_pembayaran" => $request->metode_pembayaran,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
    }

    // Delete a transaction
    public function destroy($id){
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}

