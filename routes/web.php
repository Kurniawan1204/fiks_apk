<?php

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login'); // Ganti 'welcome' dengan 'login'
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reload-captcha', [AuthController::class, 'reloadCaptcha']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [TransaksiController::class, 'countTransaksiPerDay'])->name('home');
    Route::get('Transaksi', [TransaksiController::class, 'transaksi']);
    Route::get('transaksi/permohonan', [TransaksiController::class, 'permohonan']);
    Route::get('transaksi/bayar', [TransaksiController::class, 'jumlahBayar']);
    Route::get('/transaksi/validasi', [TransaksiController::class, 'validasi'])->name('validasi');
    Route::get('transaksi/add', [TransaksiController::class, 'add']);
    Route::post('Transaksi', [TransaksiController::class, 'process']);    
    Route::get('transaksi/edit/{id}', [TransaksiController::class, 'edit']);
    Route::get('transaksi/show/{id}', [TransaksiController::class, 'show']);
    Route::patch('Transaksi/{id}', [TransaksiController::class, 'editprocess']);
    Route::get('laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::get('/export-laporan', [TransaksiController::class, 'exportLaporan'])->name('export.laporan');
});
