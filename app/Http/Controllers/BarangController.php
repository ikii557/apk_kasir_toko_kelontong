<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Display all items
    public function index(Request $request){
        if ($request->search) {
            $barangs = Barang::where(
                                  "nama_barang","LIKE","%". $request->search ."%")
                            ->orWhere(
                                  "stok_barang","LIKE","%". $request->search ."%")
                            ->orWhere(
                                "harga_barang","LIKE","%". $request->search ."%")
                            ->paginate(8);
                }else{
                  $barangs = Barang::paginate(8);
        }
        return view("pages.barang.barang", compact("barangs"));
    }
    public function create(){
        $barangs = Barang::all();
        return view("pages.barang.tambahbarang", compact("barangs"));
    }
    public function store(Request $request)
{
    $request->validate([
        'nama_barang' => 'required|unique:barangs,nama_barang',
        'stok_barang' => 'required',
        'harga_barang' => 'required',
    ], [
        'nama_barang.required' => 'barang harus di isi',
        'nama_barang.unique' => 'barang sudah ada harap masukan barang yang belum ada',
        'stok_barang.required' => 'stok harus di isi',
        'harga_barang.required' => 'harga harus di isi',
    ]);


    $storeDataBarang = [
        'nama_barang' => $request->nama_barang,
        'stok_barang' => $request->stok_barang,
        'harga_barang' => $request->harga_barang,
    ];

    Barang::create($storeDataBarang);
    return redirect('/barang')->with('success', 'Barang berhasil di tambahkan');
}

    public function edit($id){
        $dataBarang = Barang::find($id);
        return view('pages.barang.editbarang',compact('dataBarang'));

    }
    public function update(Request $request, $id){
        $request->validate([
            'nama_barang'=>'required',
            'stok_barang'=> 'required',
            'harga_barang'=> 'required',
        ],[
            'nama_barang.required'=> 'barang harus di isi',
            'stok_barang.required'=> 'stok ahrus di isi',
            'harga_barang.required'=> 'harga harus di isi',
        ]);

        $updateDataBarang=[
            'nama_barang'=> $request->nama_barang,
            'stok_barang'=> $request->stok_barang,
            'harga_barang'=> $request->harga_barang,
        ];

       Barang::find($id)->update($updateDataBarang);
        return redirect('/barang')->with('success','Barang berhasil di edit');
    }

   public function destroy($id)
    {
        // Find the record in the 'barang' table by its ID
        $barang = Barang::findOrFail($id);

        // Delete the record
        $barang->delete();

        // Redirect back to the 'barang' list page with a success message
        return redirect('/barang')->with('success', 'Barang berhasil dihapus!');
    }


}
