<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get("/login", function () {
    return view("akun.login");
});
Route::get("/register", action: function () {
    return view("akun.register");
});

Route::get('/', function () {
    return view('pages.dasboard.index');
});

Route::get('/barang', function () {
    return view('pages.barang.barang');
});

Route::get('/profile', function () {
    return view('pages.user.profile');
});

Route::get('/transaksi', function () {
    return view('pages.transaksi.transaksi');
});
