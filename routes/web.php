<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;



Route::get('/', function () {
    return view('dashboard');
});

Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/tambah', [ProdukController::class, 'store'])->name('produk.create');
    Route::post('/', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/hapus/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
}); 