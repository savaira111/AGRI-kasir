<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransactionController;

// Dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// Produk
Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/hapus/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/{id}', [ProdukController::class, 'show'])->name('produk.show');
});


// Transactions
Route::prefix('transactions')->group(function () {
    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
});

