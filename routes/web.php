<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\DashboardController;

// ==========================
// AUTH (Login - Logout)
// ==========================

// Halaman login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login')
    ->middleware('guest');

// Proses login
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process')
    ->middleware('guest');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// ==========================
// REDIRECT ROOT
// ==========================
Route::get('/', function () {
    return redirect()->route('dashboard');
});


// ==========================
// ROUTE YANG BUTUH LOGIN
// ==========================
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // ============
    // PRODUK
    // ============
    Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/tambah', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');   // <- ini
    Route::put('/{id}', [ProdukController::class, 'update'])->name('produk.update');    // <- ini
    Route::delete('/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/{id}', [ProdukController::class, 'show'])->name('produk.show');
    });


    // ============
    // TRANSAKSI
    // ============
    Route::prefix('transactions')->group(function () {

    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::get('/search-product', [ProdukController::class, 'search'])->name('product.search');
    Route::post('/', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/show/{id}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::delete('/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');
    Route::get('/', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/pdf/{id}', [TransactionController::class, 'pdf'])->name('transactions.pdf');
    });

    
   Route::prefix('laporan')->group(function () {
    Route::get('/', [LaporanPenjualanController::class, 'index'])->name('laporan.index');
    Route::post('/generate', [LaporanPenjualanController::class, 'generate'])->name('laporan.generate');
    Route::get('/export/{id}', [LaporanPenjualanController::class, 'exportPdf'])->name('laporan.exportPdf');
});

    Route::get('/dashboard', [DashboardController::class, 'index'])
     ->name('dashboard')
        ->middleware('auth');

});
