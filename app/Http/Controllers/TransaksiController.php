<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function index()
    {
        $transaksi = Transaksi::all();
        return view("/transaksi", compact("transaksi"));
    }
}
