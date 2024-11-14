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
        $detailtransaksi = DetailTransaksi::where('total_harga ');

        return view('pages.transaksi.transaksi', compact('transaksis', 'barangs','detailtransaksi'));
    }


    public function create(){
        $barangs = Barang::all();
        $transaksis = Transaksi::all();
         // Get the latest transaction number and increment it
        $lastTransaksi = Transaksi::orderBy('created_at', 'desc')->first();
        $newTransaksiNumber = $lastTransaksi ? 'TM-' . str_pad((int) substr($lastTransaksi->no_transaksi, 3) + 1, 4, '0', STR_PAD_LEFT) : 'TR-0001';
        return view("pages.transaksi.tambahtransaksi", compact("transaksis","barangs", "newTransaksiNumber"));
    }

public function store(Request $request)

{
    // Validate the input data
    $request->validate([
        'no_transaksi' => 'required|unique:transaksis,no_transaksi',
        'metode_pembayaran' => 'required',
    ], [
        'no_transaksi.required' => 'Nomor transaksi harus diisi',
        'no_transaksi.unique' => 'Nomor transaksi sudah terdaftar',
        'metode_pembayaran.required' => 'Metode pembayaran harus diisi'
    ]);



    // Set transaction date to current date if not provided
    $tanggalTransaksi = $request->tanggal_transaksi ?? now();

    // Check if stock is sufficient for all items before creating the transaction
    foreach ($request->barang_id as $index => $nama_barang) {
        $jumlahbarang = $request->jumlah_barang[$index];
        $barang = Barang::find($nama_barang);

        if ($barang->stok_barang < $jumlahbarang) {
            return redirect()->back()->with('error', "Stok tidak mencukupi untuk barang: $barang->nama_barang.");
        }
    }

    // Create new transaction with the logged-in user's ID
    $transaksi = Transaksi::create(attributes: [
        'no_transaksi' => $request->no_transaksi  ,
        'tanggal_transaksi' => $tanggalTransaksi,
        'metode_pembayaran' => $request->metode_pembayaran,
        'user_id' => Auth::id(), // Set the user ID
    ]);

    // Handle detail transaction and update stock
    foreach ($request->barang_id as $index => $nama_barang) {
        $jumlahbarang = $request->jumlah_barang[$index];
        $barang = Barang::find($nama_barang);
        $total_harga = $barang->harga_barang * $jumlahbarang;

        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'barang_id' => $nama_barang,
            'jumlah_barang' => $jumlahbarang,
            'total_harga' => $total_harga,
        ]);

        $barang->decrement('stok_barang', $jumlahbarang);
    }

    return redirect('/transaksi')->with('success', 'Transaksi berhasil disimpan.');
}











public function edit($id)
{
    $transaksi = Transaksi::with('detailTransaksi')->find($id); // Load transaction details
    $barangs = Barang::all(); // Get all available products
    $users = User::all(); // Get all cashiers

    return view('pages.transaksi.edittransaksi', compact('transaksi', 'barangs', 'users'));
}


public function update(Request $request, $id)
{
    $request->validate([
        "detail_transaksi.*.barang_id"   => "required",
        "detail_transaksi.*.jumlah_barang" => "required|min:1",
        "detail_transaksi.*.total_harga"   => "required",
    ],[
        "detail_transaksi.*.barang_id.required"        => "Nama barang harus diisi",
        "detail_transaksi.*.jumlah_barang.required"    => "Jumlah barang harus diisi",
        "detail_transaksi.*.jumlah_barang.min"         => "Barang minimal 1",
        "detail_transaksi.*.total_harga.required"      => "Total harga harus diisi",
    ]);

    $transaksi = Transaksi::findOrFail($id);
    $inputDetailIds = collect($request->detail_transaksi)->pluck('id')->filter();

    // Delete removed items
    DetailTransaksi::where('transaksi_id', $transaksi->id)
        ->whereNotIn('id', $inputDetailIds)
        ->delete();

    // Update or add items
    foreach ($request->detail_transaksi as $key => $item) {
        $barang = Barang::findOrFail($item['barang_id']);
        $jumlahBarang = $item['jumlah_barang'];

        $detail = DetailTransaksi::updateOrCreate(
            ['id' => $item['id'] ?? null],
            [
                'transaksi_id'   => $transaksi->id,
                'barang_id'      => $item['barang_id'],
                'jumlah_barang'  => $jumlahBarang,
                'total_harga'    => $item['total_harga'],
            ]
        );

        $oldJumlah = $detail->exists ? $detail->jumlah_barang : 0;
        $stokAdjustment = $jumlahBarang - $oldJumlah;

        if ($barang->stok_barang < $stokAdjustment) {
            return redirect()->back()->with('error', "Stok tidak mencukupi untuk barang: {$barang->nama_barang}.");
        }

        $barang->decrement('stok_barang', $stokAdjustment);
    }

    return redirect("/transaksi")->with("success", "Transaksi berhasil diupdate.");
}






public function destroy($id)
{
    // Temukan data transaksi berdasarkan ID
    $transaksi = Transaksi::findOrFail($id);

    // Hapus detail transaksi terkait
    $transaksi->detailTransaksi()->delete();

    // Hapus data transaksi
    $transaksi->delete();

    // Arahkan kembali ke halaman transaksi dengan pesan sukses
    return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus!');
}




public function print($id)
{
    // Ambil transaksi beserta detail barang yang terkait
    $transaksis = Transaksi::with(['detailTransaksi.barang' => function ($query) {
        // Hanya ambil barang yang stoknya lebih dari 0
        $query->where('stok_barang', '>', 0);
    }])->findOrFail($id);

    // Filter out any detailTransaksi where the barang is out of stock
    $filteredDetails = $transaksis->detailTransaksi->filter(function ($detail) {
        return $detail->barang && $detail->barang->stok_barang > 0;
    });

    // Calculate the total payment for available items
    $totalPayment = $filteredDetails->reduce(function ($carry, $detail) {
        return $carry + ($detail->jumlah_barang * $detail->barang->harga_barang);
    }, 0);

    // Pass only available items to the view
    return view('dokumentasi.struktransaksi', compact('transaksis', 'totalPayment', 'filteredDetails'));
}





}

