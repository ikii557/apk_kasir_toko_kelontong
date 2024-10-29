<?php
// app/Http/Controllers/LaporanController.php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $query = Transaksi::query()->with(['detailTransaksi.barang', 'kasir']);

        // Apply date filters if provided
        if ($request->start_date) {
            $query->whereDate('tanggal_transaksi', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('tanggal_transaksi', '<=', $request->end_date);
        }

        // Filter by kasir if selected
        if ($request->kasir) {
            $query->where('kasir_id', $request->kasir);
        }

        $transactions = $query->get();
        $kasirs = User::where('role', 'kasir')->get();

        // Calculate total outgoing items and daily income
        $dailyReport = $transactions->groupBy(function($item) {
            return Carbon::parse($item->tanggal_transaksi)->format('Y-m-d');
        })->map(function($dayTransactions) {
            $totalPengeluaran = $dayTransactions->sum(function($transaction) {
                return $transaction->detailTransaksi->sum('jumlah_barang');
            });
            $totalPemasukan = $dayTransactions->sum(function($transaction) {
                return $transaction->detailTransaksi->sum('total_harga');
            });

            return [
                'totalPengeluaran' => $totalPengeluaran,
                'totalPemasukan' => $totalPemasukan,
            ];
        });

        return view('report', compact('transactions', 'kasirs', 'dailyReport'.'users'));
    }
}
