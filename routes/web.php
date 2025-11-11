<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaProdukController;


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/kelola-produk', [KelolaProdukController::class, 'index'])->name('kelola.produk');

