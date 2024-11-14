<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function index()
    {
        // Get total products sold and stock count
        $produkTerjual = Transaksi::count();
        $stokBarang = Barang::where('stok_barang', '>', 0)->count();


        $detail = DetailTransaksi::sum('total_harga');
        $formattedDetail = number_format($detail, 0, ',', '.');

        $totaladmin = User::where('role', 'admin')->count();



        return view('pages.dasboard.index', compact('produkTerjual', 'stokBarang', 'detail','formattedDetail','totaladmin'));
    }

}
