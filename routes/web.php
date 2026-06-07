<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MitraController as AdminMitraController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\LaporanController;

// landing
Route::get('/', [LandingController::class, 'index'])->name('home');

// Pencarian
Route::get('/pencarian', [PencarianController::class, 'index'])->name('pencarian');

// Detail
Route::get('/detail/{id}', [DetailController::class, 'index'])->name('detail');

// Chat
Route::get('/chat/{id}', [ChatController::class, 'index'])->name('chat');

// Order
Route::get('/order/{id}', [OrderController::class, 'index'])->name('order');
Route::post('/order/proses', [OrderController::class, 'proses'])->name('order.proses');

// Tagihan
Route::get('/tagihan/{id}', [TagihanController::class, 'index'])->name('tagihan');

// Gabung_Mitra
Route::get('/gabung-mitra', [MitraController::class, 'index'])->name('mitra');
Route::post('/gabung-mitra', [MitraController::class, 'proses'])->name('mitra.proses');

// Auth
Route::get('/masuk', [AuthController::class, 'showLogin'])->name('login');
Route::post('/masuk', [AuthController::class, 'prosesLogin'])->name('login.proses');
Route::get('/daftar', [AuthController::class, 'showDaftar'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'prosesDaftar'])->name('daftar.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yang butuh login
Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/profil', [ProfilController::class, 'hapus'])->name('profil.hapus');

    // Pesanan
    Route::get('/pesanan-saya', [OrderController::class, 'pesananSaya'])->name('pesanan.saya');
    Route::get('/pesanan-masuk', [OrderController::class, 'pesananMasuk'])->name('pesanan.masuk');
});

// Admin
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/mitra', [AdminMitraController::class, 'index'])->name('mitra');
        Route::put('/mitra/{id}/approve', [AdminMitraController::class, 'approve'])->name('mitra.approve');
        Route::put('/mitra/{id}/reject', [AdminMitraController::class, 'reject'])->name('mitra.reject');
        Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    });