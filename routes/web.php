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
Route::get('/', function () {
    return view('pages.dasboard.index2');
});

// Rute untuk pengguna tamu
Route::middleware(['guest'])->group(function () {
    // Registrasi
    Route::get("/register", [AuthController::class, 'register']);
    Route::post('/store/register', [AuthController::class, 'storeregister']);

    // Login
    Route::get("/login", [AuthController::class, 'login'])->name('login');
    Route::post('/store/login', [AuthController::class, 'storelogin']);
});







// Rute untuk pengguna yang terotentikasi
Route::middleware(['auth'])->group(function () {
    // Halaman Admin Dashboard (akses oleh admin dan super admin)
    Route::middleware(['role:admin,superadmin'])->group(function () {
        Route::get('/index', [DasboardController::class, 'index']);
        Route::get('/datatable', function () {
            return view('pages.data.datatable');
        });

        // Profil
        Route::get('/profile', function () {
            return view('pages.user.profile');
        });
        Route::get('/editprofile', [Controller::class, 'edit']);
        Route::post('/store/user', [Controller::class, 'store']);

        // Laporan
        Route::get('/report', [ReportController::class, 'index'])->name('report.index');

        // Logout
        Route::get('/logout', [AuthController::class, 'logout']);

        // Barang Management (Admin dan Super Admin akses)
        Route::get('/barang', [BarangController::class, 'index']);
        Route::get('/tambahbarang', [BarangController::class, 'create']);
        Route::post('/store/barang', [BarangController::class, 'store']);
        Route::get('/editbarang/{id}', [BarangController::class, 'edit']);
        Route::post('/updatebarang/{id}', [BarangController::class, 'update']);

        // Transaksi (view and create only for admin and super admin)
        Route::get('/transaksi', [TransaksiController::class, 'index']);
        Route::get('/tambahtransaksi', [TransaksiController::class, 'create']);
        Route::post('/store/transaksi', [TransaksiController::class, 'store']);
    });

    // Rute khusus untuk Super Admin (akses penuh termasuk edit dan hapus transaksi)
    Route::middleware(['role:super admin'])->group(function () {

        // Full access to Barang Management (Super Admin access)
        Route::get('/destroy/barang/{id}', [BarangController::class, 'destroy']);

        // Full access to Transaksi Management (Super Admin access)
        Route::get('/edittransaksi/{id}', [TransaksiController::class, 'edit']);
        Route::post('/updatetransaksi/{id}', [TransaksiController::class, 'update']);
        Route::get('/destroy/transaksi/{id}', [TransaksiController::class, 'destroy']);
        Route::get('/print/{id}', [TransaksiController::class, 'print'])->name('transaksi.print');
    });
});
