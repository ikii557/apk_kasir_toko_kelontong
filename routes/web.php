<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\TransaksiController;

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


Route::get('/',function(){
    return view('pages.dasboard.index2');
});

Route::middleware(['guest'])->group(function () {
    // register
    Route::get("/register", [AuthController::class,'register'] );
    Route::post('/store/register', [AuthController::class,'storeregister'] );
    //login
    Route::get("/login", [AuthController::class,'login'] )->name('login');
    Route::post('/store/login', [AuthController::class,'storelogin'] );

});




Route::middleware(['auth'])->group(function(){

    // dasboard
Route::get('/index', [DasboardController::class,'index'] );
Route::get('/datatable', function () {
    return view('pages.data.datatable');
});


// barang
Route::get('/barang', [BarangController::class,'index'] );
Route::get('/tambahbarang', [BarangController::class,'create'] );
Route::post('/store/barang', [BarangController::class,'store']) ;
Route::get('/editbarang/{id}',[BarangController::class,'edit']) ;
Route::post('/updatebarang/{id}', [BarangController::class,'update']);
Route::get('/destroy/{id}', [BarangController::class,'destroy']);



// profile
Route::get('/profile', function () {
    return view('pages.user.profile');
});
Route::get('/editprofile', [Controller::class,'edit']);
Route::post('/store/user', [Controller::class,'store'] );


// transaksi
Route::get('/transaksi', [TransaksiController::class, 'index']);
Route::get('/tambahtransaksi', [TransaksiController::class, 'create']);
Route::post('/store/transaksi', [TransaksiController::class, 'store']);
Route::get('/edittransaksi/{id}',[TransaksiController::class,'edit']) ;
Route::post('/updatetransaksi/{id}', [TransaksiController::class,'update']);
Route::get('/destroy/{id}', [TransaksiController::class,'destroy']);


Route::get('/print/{id}', [TransaksiController::class, 'print'])->name('transaksi.print');



//logout
Route::get('/logout', [AuthController::class,'logout']);
});
