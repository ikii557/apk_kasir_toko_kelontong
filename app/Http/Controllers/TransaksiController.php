<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Display all transactions
    public function index(Request $request){
        $barangs = Barang::all();
        if ($request->search) {

            $transaksis = Transaksi::whereHas('barang', function ($query) use ($request) {
                    $query->where('nama_barang', 'LIKE', '%' . $request->search . '%');
                })

                ->orWhere('jumlah_barang', 'LIKE', '%' . $request->search . '%')
                                ->orWhere('total_harga', 'LIKE', '%' . $request->search . '%')
                ->orWhere('metode_pembayaran', 'LIKE', '%' . $request->search . '%')
                ->paginate(5);
        } else {

            $transaksis = Transaksi::paginate(5);
        }

        return view("pages.transaksi.transaksi", compact("transaksis","barangs"));
    }

    public function create(){
        $barangs = Barang::all();
        $transaksis = Transaksi::all();
        return view("pages.transaksi.tambahtransaksi", compact("transaksis","barangs"));
    }



    public function store(Request $request){

        $request->validate([
            "nomor_transaksi"   => "required",
            "tanggal_transaksi" => "required",
            "kasir"             => "required",
            "barang_id"         => "required",
            "jumlah_barang"     => "required",
            "total_harga"       => "required",
            "metode_pembayaran" => "required",
        ]);


        $storeDataTransaksi=[
            "no_transaksi"      => $request->no_transaksi,
            "tanggal_transaksi" => $request->tanggal_transaksi,
            "kasir"             => Auth::user()->id,
            "barang_id"         => $request->barang_id,
            "jumlah_barang"     => $request->jumlah_barang,
            "total_harga"       => $request->total_harga,
            "metode_pembayaran" => $request->metode_pembayaran,
        ];
        Transaksi::create($storeDataTransaksi);
        return redirect("/transaksi")->with("success","transaksi selesai");
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
}

