<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;

// Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

// Produk
Route::resource('produk', ProdukController::class);

// Transaksi
Route::resource('transaksi', TransaksiController::class);

// Pembayaran
Route::resource('pembayaran', PembayaranController::class);
Route::get('pembayaran/create/{id_transaksi}', [PembayaranController::class, 'create'])->name('pembayaran.create');

// Laporan
Route::resource('laporan', LaporanController::class);

// User
Route::resource('user', UserController::class);
