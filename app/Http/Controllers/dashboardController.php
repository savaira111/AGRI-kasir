<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // menghitung total produk yang di buat
        $totalProduk = Produk::count();

        // menghintung transaksi yang pernah dilakukan
        $totalTransaksi = Transaction::count();

        // menjumlahkan semua total harga dari semua transaksi
        $totalPendapatan = Transaction::sum('total_harga');


        // Data revenue chart (6 bulan terakhir)
        $revenue = []; // 
        $labels = []; // menyimpan nama bulan
        for ($i = 5; $i >= 0; $i--) { // Perulangan untuk mengambil data dari 6 bulan terakhir
            $month = now()->subMonths($i)->month; 
            $labels[] = now()->subMonths($i)->format('M');  // ngambil nama bulan, misalnya "Jan", "Feb", "Mar"

            $monthly = Transaction::whereMonth('tanggal_transaksi', $month)
                ->sum('total_harga'); //memjumlahkan total pendapatan dari bulan tertentu

            $revenue[] = $monthly;
        }

        return view('dashboard', compact( // mengirim data ke halaman dashboard
            'totalProduk', 
            'totalTransaksi', 
            'totalPendapatan', 
            'revenue', 
            'labels'
        ));
    }
}
