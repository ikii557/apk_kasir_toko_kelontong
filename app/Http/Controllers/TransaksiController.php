<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Display all transactions
    public function index(Request $request)
    {
        $barangs = Barang::all();
        $transaksis = Transaksi::all();
        $detailtransaksis = DetailTransaksi::all();
        return view('pages.transaksi.transaksi', compact('transaksis', 'barangs','detailtransaksis'));
    }


    public function create(){
        $barangs = Barang::all();
        $transaksis = Transaksi::all();
        return view("pages.transaksi.tambahtransaksi", compact("transaksis","barangs"));
    }
    // Store new transaction
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'no_transaksi' => 'required',
            'tanggal_transaksi' => 'required',
            'metode_pembayaran' => 'required',
            'barang_id' => 'required|array',
            'jumlah_barang' => 'required|array',
        ]);

        // Create new transaction
        $transaksi = Transaksi::create([
            'no_transaksi' => $request->no_transaksi,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        // Handle detail transaction (loop through each selected item)
        foreach ($request->barang_id as $index => $barangId) {
            $jumlahBarang = $request->jumlah_barang[$index];
            $barang = Barang::find($barangId);
            $totalHarga = $barang->harga * $jumlahBarang;

            // Store detail transaction
            DetailTransaksi::create([
                'transaksi_id' => $transaksi->id,
                'barang_id' => $barangId,
                'jumlah_barang' => $jumlahBarang,
                'total_harga' => $totalHarga,
            ]);

            // Update stock of the item (barang)
            $barang->decrement('stok_barang', $jumlahBarang);
            
        }

        return redirect('/transaksi')->with('success', 'Transaksi berhasil disimpan.');
    }








    public function edit($id){
        $barangs = Barang::all();
        $transaksis = Transaksi::find($id);
        return view("pages.transaksi.edittransaksi", compact("barangs","transaksis"));
    }
    public function update(Request $request, $id){
        $request->validate([
            "barang_id"         => "required",
            "jumlah_barang"     => "required",
            "total_harga"       => "required",
            "metode_pembayaran" => "required",
        ],[
            "barang_id.required"        => "barang harus di isi ",
            "jumlah_barang.required"    => "jumlah harus di isi ",
            "total_harga.required"      => "totoal  nya harus di isi",
            "metode_pembayaran.required"=> "pilih metode pembayaran yang harus di isi",
        ]);
        $updateDataTransaksi=[
            "barang_id"         => $request->barang_id,
            "jumlah_barang"     => $request->jumlah_barang,
            "total_harga"       => $request->total_harga,
            "metode_pembayaran" => $request->metode_pembayaran,
        ];

        Transaksi::find($id)->update($updateDataTransaksi);
        return redirect("/transaksi")->with("success","transaksi berhasil di edit");
    }

    public function destroy($id)
    {
        // Find the record in the 'barang' table by its ID
        $transaksi = Transaksi::findOrFail($id);

        // Delete the record
        $transaksi->delete();

        // Redirect back to the 'barang' list page with a success message
        return redirect('/transaksi')->with('success', 'Barang berhasil dihapus!');
    }



    public function print($id)
    {
        // Ambil transaksi beserta detail barang yang terkait
        $transaksis = Transaksi::with('detailTransaksi.barang')->findOrFail($id);
        $detailll = DetailTransaksi::sum('total_harga');

        return view('dokumentasi.struktransaksi', compact('transaksis','detailll'));
    }



}

