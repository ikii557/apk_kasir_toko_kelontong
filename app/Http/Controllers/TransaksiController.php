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
        return view("pages.transaksi.tambahtransaksi", compact("transaksis","barangs"));
    }
    // Store new transaction
    public function store(Request $request)
{
    // Validate the input data
    $request->validate([
        'no_transaksi' => 'required|unique:transaksis,no_transaksi',
        'tanggal_transaksi' => 'required',
        'metode_pembayaran' => 'required',
    ], [
        'no_transaksi.required' => 'Nomor transaksi harus diisi',
        'no_transaksi.unique' => 'Nomor transaksi sudah terdaftar',
        'tanggal_transaksi.required' => 'Tanggal transaksi harus diisi',
        'metode_pembayaran.required' => 'Metode pembayaran harus diisi'
    ]);

    // Check if stock is sufficient for all items before creating the transaction
    foreach ($request->barang_id as $index => $nama_barang) {
        $jumlahbarang = $request->jumlah_barang[$index];
        $barang = Barang::find($nama_barang);

        // Check if stock is sufficient
        if ($barang->stok_barang < $jumlahbarang) {
            // Redirect back with an error message if stock is insufficient
            return redirect()->back()->with('error', "Stok tidak mencukupi untuk barang: $barang->nama_barang. Silakan periksa kembali jumlah barang.");
        }
    }

    // Create new transaction if all items have sufficient stock
    $transaksi = Transaksi::create([
        'no_transaksi' => $request->no_transaksi,
        'tanggal_transaksi' => $request->tanggal_transaksi,
        'metode_pembayaran' => $request->metode_pembayaran,
    ]);

    // Handle detail transaction and update stock
    foreach ($request->barang_id as $index => $nama_barang) {
        $jumlahbarang = $request->jumlah_barang[$index];
        $barang = Barang::find($nama_barang);
        $total_harga = $barang->harga_barang * $jumlahbarang;

        // Store detail transaction
        DetailTransaksi::create([
            'transaksi_id' => $transaksi->id,
            'barang_id' => $nama_barang,
            'jumlah_barang' => $jumlahbarang,
            'total_harga' => $total_harga,
        ]);

        // Update stock of the item (barang)
        $barang->decrement('stok_barang', $jumlahbarang);
    }

    // Redirect to the transaction page with a success message
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









    public function print($id)
    {
        // Ambil transaksi beserta detail barang yang terkait
        $transaksis = Transaksi::with('detailTransaksi.barang')->findOrFail($id);

        // Calculate the total payment
        $totalPayment = $transaksis->detailTransaksi->reduce(function ($carry, $detail) {
            return $carry + ($detail->jumlah_barang * $detail->barang->harga_barang);
        }, 0);

        return view('dokumentasi.struktransaksi', compact('transaksis', 'totalPayment'));
    }

    public function dailyReport()
    {
        $today = now()->format('Y-m-d'); // Get today's date

        // Retrieve transactions for today with details and user info
        $transaksis = Transaksi::with(['detailTransaksi.barang', 'user'])
            ->whereDate('tanggal_transaksi', $today)
            ->get();

        // Calculate the total revenue and total items sold
        $total_harga = $transaksis->flatMap->detailTransaksi->sum(function ($detail) {
            return $detail->jumlah_barang * $detail->barang->harga_barang;
        });

        $total_barang = $transaksis->flatMap->detailTransaksi->sum('jumlah_barang');

        // Return the view with the required data
        return view('dokumentasi.struktransaksi', compact('transaksis', 'total_harga', 'total_barang'));
    }



}

