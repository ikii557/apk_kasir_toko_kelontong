<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve the date range from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Fetch outgoing transactions ('pengeluaran'), including related 'DetailTransaksi' records
        $query = Transaksi::whereHas('detailtransaksi', function ($query) {
            $query->where('metode_pembayaran', 'pengeluaran');
        });

        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        }

        $pengeluaran = $query->with(['detailtransaksi', 'user'])
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        return view('pages.data.laporan', compact('pengeluaran', 'startDate', 'endDate'));
    }
}
