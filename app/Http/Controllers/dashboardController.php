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
        // Total Produk
        $totalProduk = Produk::count();

        // Total Transaksi
        $totalTransaksi = Transaction::count();

        // Total Pendapatan
        $totalPendapatan = Transaction::sum('total_harga');

        // Total Laba / Keuntungan (sementara pakai total_harga)
        // nanti bisa diganti kalau ada kolom harga_modal
        $total_laba = $totalPendapatan;

        // Data revenue chart (6 bulan terakhir)
        $revenue = [];
        $labels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->month;
            $labels[] = now()->subMonths($i)->format('M');

            $monthly = Transaction::whereMonth('tanggal_transaksi', $month)
                ->sum('total_harga');

            $revenue[] = $monthly;
        }

        return view('dashboard', compact(
            'totalProduk', 
            'totalTransaksi', 
            'totalPendapatan', 
            'total_laba', 
            'revenue', 
            'labels'
        ));
    }
}
