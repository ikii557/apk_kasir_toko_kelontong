<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TransaksiController;
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

Route::middleware(['guest'])->group(function () {
    // register
    Route::get("/register", [AuthController::class,'register'] );
    Route::post('/store/register', [AuthController::class,'storeregister'] );
    //login
    Route::get("/login", [AuthController::class,'login'] )->name('login');
    Route::post('/store/login', [AuthController::class,'storelogin'] );

});

Route::middleware(['auth'])->group(function(){
Route::get('/', function () {
    return view('pages.dasboard.index');
});
// barang
Route::get('/barang', [BarangController::class,'index'] );
Route::get('/tambahbarang', [BarangController::class,'create'] );
Route::post('/store', [BarangController::class,'store']) ;
Route::get('/editbarang', function () {
    return view('pages.barang.editbarang');
});



// profile
Route::get('/profile', function () {
    return view('pages.user.profile');
});
Route::get('/editprofile', [Controller::class,'edit']);
Route::get('/tambahuser', [Controller::class,'create'] );
Route::post('/store', [Controller::class,'store'] );


// transaksi
Route::get('/tambahtransaksi', [TransaksiController::class, 'create']);
Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');



//logout
Route::get('/logout', [AuthController::class,'logout']);
});
