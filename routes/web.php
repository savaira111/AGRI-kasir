<?php

use Illuminate\Support\Facades\Route;

// Halaman login
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Proses "login" palsu (langsung masuk dashboard aja)
Route::post('/login', function () {
    return redirect()->route('dashboard')->with('success', 'Selamat anda telah berhasil login');
})->name('login.process');

// Dashboard
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');