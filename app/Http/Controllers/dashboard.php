<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //  Halaman utama dashboard
    public function index()
    {
        // Hitung total produk
        $totalProduk = Produk::count();

        // Hitung total transaksi
        $totalTransaksi = Transaksi::count();

        // Hitung total pendapatan (dari semua transaksi yang lunas)
        $totalPendapatan = Transaksi::where('status', 'Lunas')->sum('total_harga');

        // Hitung pendapatan hari ini
        $pendapatanHariIni = Transaksi::whereDate('tanggal_transaksi', today())
                                      ->where('status', 'Lunas')
                                      ->sum('total_harga');

        // Ambil transaksi terbaru (5 terakhir)
        $transaksiTerbaru = Transaksi::with('pembayaran')->latest()->take(5)->get();

        // Kirim semua data ke view
        return view('dashboard.index', compact(
            'totalProduk',
            'totalTransaksi',
            'totalPendapatan',
            'pendapatanHariIni',
            'transaksiTerbaru'
        ));
    }
}
