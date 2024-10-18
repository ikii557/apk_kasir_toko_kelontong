<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class DasboardController extends Controller
{
    //
    public function index(){
        $produkTerjual = Transaksi::count();
        $stokBarang = Barang::where('stok_barang', '>', 0)->count();
        $transaksis = Transaksi::sum('total_harga');
        return view('pages.dasboard.index',compact('produkTerjual', 'stokBarang', 'transaksis'));
    }
}
