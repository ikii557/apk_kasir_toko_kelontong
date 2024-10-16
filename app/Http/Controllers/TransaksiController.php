<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function index()
    {
        $transaksis =transaksi::all();
        return view("pages.transaksi.transaksi", compact("transaksis"));
    }
    public function create()
    {
        $transaksis = Transaksi::all();
        return view("pages.transaksi.tambahtransaksi", compact("transaksis"));
    }
}
