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
    return view("pages.akun.login");
});

Route::get("/register", function () {
    return view("pages.akun.register");
});

Route::get('/', function () {
    return view('pages.dasboard.index');
});
// barang
Route::get('/barang', function () {
    return view('pages.barang.barang');
});
Route::get('/tambahbarang', function () {
    return view('pages.barang.tambahbarang');
});
Route::get('/editbarang', function () {
    return view('pages.barang.editbarang');
});



// profile
Route::get('/profile', function () {
    return view('pages.user.profile');
});
Route::get('/tambahuser', function () {
    return view('pages.user.tambahuser');
});


// transaksi
Route::get('/transaksi', function () {
    return view('pages.transaksi.transaksi');
});
Route::get('/tambahtransaksi', function () {
    return view('pages.transaksi.tambahtransaksi');
});
Route::get('/edittransaksi', function () {
    return view('pages.transaksi.edittransaksi');
});
