<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Display all items
    public function index(){
        $barangs = Barang::all();
        return view("pages.barang.barang", compact("barangs"));
    }

    // Show form to create new item
    public function create(){
        return view('pages.barang.tambahbarang');
    }

    // Store new item in database
    public function store(Request $request){
        $request->validate([
            "nama_barang" => "required",
            "harga_barang" => "required|numeric",
            "stok_barang" => "required|numeric",
        ]);

        Barang::create([
            "nama_barang" => $request->nama_barang,
            "harga_barang" => $request->harga_barang,
            "stok_barang" => $request->stok_barang,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }

    // Show form to edit an item
    public function edit($id){
        $barang = Barang::findOrFail($id);
        return view('pages.barang.edit', compact('barang'));
    }

    // Update item in database
    public function update(Request $request, $id){
        $request->validate([
            "nama_barang" => "required",
            "harga_barang" => "required|numeric",
            "stok_barang" => "required|numeric",
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            "nama_barang" => $request->nama_barang,
            "harga_barang" => $request->harga_barang,
            "stok_barang" => $request->stok_barang,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }

    // Delete an item
    public function destroy($id){
        $barang = Barang::findOrFail($id);
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
