<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\OrderController;

// landing
Route::get('/', [LandingController::class, 'index'])->name('home');

//Pencarian
Route::get('/pencarian', [PencarianController::class, 'index'])->name('pencarian');

//Detail
Route::get('/detail/{id}', [DetailController::class, 'index'])->name('detail');

//Chat
Route::get('/chat/{id}', [ChatController::class, 'index'])->name('chat');

//Order
Route::get('/order/{id}', [OrderController::class, 'index'])->name('order');
Route::post('/order/proses', [OrderController::class, 'proses'])->name('order.proses');

// Auth
Route::get('/masuk', [AuthController::class, 'showLogin'])->name('login');
Route::post('/masuk', [AuthController::class, 'prosesLogin'])->name('login.proses');
Route::get('/daftar', [AuthController::class, 'showDaftar'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'prosesDaftar'])->name('daftar.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profil', function() { return view('profil'); })->name('profil');
    Route::get('/pesanan', function() { return view('pesanan'); })->name('pesanan');
});

