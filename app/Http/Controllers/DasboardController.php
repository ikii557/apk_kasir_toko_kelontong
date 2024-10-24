<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    public function index()
    {
        // Get total products sold and stock count
        $produkTerjual = Transaksi::count();
        $stokBarang = Barang::where('stok_barang', '>', 0)->count();

        // Get total sales
        $transaksis = Transaksi::sum('total_harga');

        // Get daily, weekly, and monthly sales data from the database
        $penjualanHarian = $this->getPenjualanPeriode('daily');
        $penjualanMingguan = $this->getPenjualanPeriode('weekly');
        $penjualanBulanan = $this->getPenjualanPeriode('monthly');

        return view('pages.dasboard.index', compact('produkTerjual', 'stokBarang', 'transaksis', 'penjualanHarian', 'penjualanMingguan', 'penjualanBulanan'));
    }

    private function getPenjualanPeriode($periode)
    {
        $query = Transaksi::selectRaw('DATE(tanggal_transaksi) as date, SUM(total_harga) as total')
                            ->groupBy('date');

        switch ($periode) {
            case 'daily':
                $query->whereDate('tanggal_transaksi', now());
                break;
            case 'weekly':
                $query->whereBetween('tanggal_transaksi', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'monthly':
                $query->whereMonth('tanggal_transaksi', now()->month);
                break;
        }

        $salesData = $query->get();

        // Return sales data in the format Chart.js expects
        return [
            'labels' => $salesData->pluck('date')->toArray(),
            'data' => $salesData->pluck('total')->toArray()
        ];
    }
}
