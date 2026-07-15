<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;

use App\Http\Controllers\Pelanggan\MenuController as PelangganMenuController;
use App\Http\Controllers\Pelanggan\PesananController;
use App\Http\Controllers\Pelanggan\PembayaranController;
use App\Http\Controllers\Pelanggan\PengumumanController as PelangganPengumumanController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

//belum login
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

//sdh login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //status pellanggan blm accept
    Route::get('/status-akun', function () {
        return view('pelanggan.status-akun');
    })->name('pelanggan.status-akun');

    //status pellanggan sdh accept
    Route::middleware(['role:customer', 'status.akun'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
        Route::get('/dashboard', function () {
            return view('pelanggan.dashboard');
        })->name('dashboard');

        Route::get('/menu', [PelangganMenuController::class, 'index'])->name('menu.index');

        Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
        Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');

        Route::get('/pesanan/{pesanan}/bayar', [PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pesanan/{pesanan}/bayar', [PembayaranController::class, 'store'])->name('pembayaran.store');

        Route::get('/pengumuman', [PelangganPengumumanController::class, 'index'])->name('pengumuman.index');
    });

    //fitur admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        //verifikasi akun
        Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
        Route::patch('/akun/{akun}/terima', [AkunController::class, 'terima'])->name('akun.terima');
        Route::patch('/akun/{akun}/tolak', [AkunController::class, 'tolak'])->name('akun.tolak');

        //verifikasi pesanan
        Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
        Route::patch('/pesanan/{pesanan}/terima', [AdminPesananController::class, 'terima'])->name('pesanan.terima');
        Route::patch('/pesanan/{pesanan}/tolak', [AdminPesananController::class, 'tolak'])->name('pesanan.tolak');

        //verifikasi pmbayaran
        Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
        Route::patch('/pembayaran/{pembayaran}/terima', [AdminPembayaranController::class, 'terima'])->name('pembayaran.terima');
        Route::patch('/pembayaran/{pembayaran}/tolak', [AdminPembayaranController::class, 'tolak'])->name('pembayaran.tolak');

        //CRUD Pengumuman
        Route::resource('pengumuman', PengumumanController::class)->except(['show']);

        //CRUD Menu
        Route::resource('menu', AdminMenuController::class)->except(['show']);
    });
});
