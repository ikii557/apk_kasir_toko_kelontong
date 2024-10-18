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
    public function create(){
        $barangs = Barang::all();
        return view("pages.barang.tambahbarang", compact("barangs"));
    }
    public function store(Request $request){
        $request->validate([
            'nama_barang'=>'required',
            'stok_barang'=> 'required',
            'harga_barang'=> 'required',
        ],[
            'nama_barang.required'=> 'barang harus di isi',
            'stok_barang.required'=> 'stok ahrus di isi',
            'harga_barang.required'=> 'harga harus di isi',
        ]);

        $storeDataBarang=[
            'nama_barang'=> $request->nama_barang,
            'stok_barang'=> $request->stok_barang,
            'harga_barang'=> $request->harga_barang,
        ];
        Barang::create($storeDataBarang);
        return redirect('/barang')->with('success','Barang berhasil di tambahkan');

}
}
