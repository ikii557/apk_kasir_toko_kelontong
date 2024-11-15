<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DasboardController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SuperAdminController;

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

// Halaman Utama

// Rute untuk pengguna tamu
Route::middleware(['guest'])->group(function () {
    // Registrasi
    Route::get("/register", [AuthController::class, 'register']);
    Route::post('/store/register', [AuthController::class, 'storeregister']);

    // Login
    Route::get("/login", [AuthController::class, 'login'])->name('login');
    Route::post('/store/login', [AuthController::class, 'storelogin']);

    Route::get('/', function () {
        return view('pages.dasboard.index2');
    });
});







// Rute untuk pengguna yang terotentikasi
Route::middleware(['auth'])->group(function () {
    // Halaman Admin Dashboard (akses oleh admin dan super admin)
    Route::middleware(['role:admin,superadmin'])->group(function () {
        Route::get('/index', [DasboardController::class, 'index']);
        Route::get('/store/laporan', [DasboardController::class, 'sal  esReport'])->name('sales-report');

        Route::get('/datatable', function () {
            return view('pages.data.datatable');
        });

        // Profil
        Route::get('/profile', [Controller::class,'profile']);

        // Laporan
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');

        // Logout
        Route::post('/logout', [AuthController::class, 'logout']);

        // Barang Management (Admin dan Super Admin akses)
        Route::get('/barang', [BarangController::class, 'index']);
        Route::get('/tambahbarang', [BarangController::class, 'create']);
        Route::post('/store/barang', [BarangController::class, 'store']);
        Route::get('/editbarang/{id}', [BarangController::class, 'edit']);
        Route::post('/updatebarang/{id}', [BarangController::class, 'update']);
        Route::get('/destroy/barang/{id}', [BarangController::class, 'destroy']);

        // Transaksi (view and create only for admin and super admin)
        Route::get('/transaksi', [TransaksiController::class, 'index']);
        Route::get('/tambahtransaksi', [TransaksiController::class, 'create']);
        Route::post('/store/transaksi', [TransaksiController::class, 'store']);
        Route::get('/print/{id}', [TransaksiController::class, 'print'])->name('transaksi.print');
    });

    // Rute khusus untuk Super Admin (akses penuh termasuk edit dan hapus transaksi)
    Route::middleware(['role:superadmin'])->group(function () {




        Route::get('/tambahkasir', [Controller::class, 'create']);
        Route::post('/store/user', [Controller::class, 'store']);



        Route::get('/editprofile/{id}', [Controller::class, 'editprofile']);
        Route::post('/updateprofile/{id}', [Controller::class, 'update']);

        Route::get('/destroyuser/{id}', [Controller::class, 'destroy']);



        // Full access to Transaksi Management (Super Admin access)
        Route::get('/edittransaksi/{id}', [TransaksiController::class, 'edit']);
        Route::post('/updatetransaksi/{id}', [TransaksiController::class, 'update']);
        Route::get('/destroy/transaksi/{id}', [TransaksiController::class, 'destroy']);
    });
});
