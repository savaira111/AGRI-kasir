<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use App\Models\Transaksi;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    //  Menampilkan laporan penjualan keseluruhan
    public function index(Request $request)
    {
        // Filter laporan berdasarkan tanggal (kalau ada)
        $mulai = $request->input('mulai');
        $sampai = $request->input('sampai');

        $laporan = Transaksi::with('pembayaran')
            ->when($mulai && $sampai, function ($query) use ($mulai, $sampai) {
                return $query->whereBetween('tanggal_transaksi', [$mulai, $sampai]);
            })
            ->get();

        // Hitung total pendapatan
        $totalPendapatan = $laporan->sum('total_harga');

        return view('laporan.index', compact('laporan', 'totalPendapatan', 'mulai', 'sampai'));
    }

    //  Simpan data laporan ke tabel laporan_penjualan (opsional)
    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id',
            'id_pembayaran' => 'required|exists:pembayaran,id',
        ]);

        LaporanPenjualan::create([
            'id_transaksi' => $request->id_transaksi,
            'id_pembayaran' => $request->id_pembayaran,
            'tanggal_laporan' => now(),
            'total_penjualan' => Transaksi::find($request->id_transaksi)->total_harga,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Data laporan berhasil disimpan!');
    }

    //  Export laporan ke file PDF
    public function exportPdf(Request $request)
    {
        $mulai = $request->input('mulai');
        $sampai = $request->input('sampai');

        $laporan = Transaksi::with('pembayaran')
            ->when($mulai && $sampai, function ($query) use ($mulai, $sampai) {
                return $query->whereBetween('tanggal_transaksi', [$mulai, $sampai]);
            })
            ->get();

        $totalPendapatan = $laporan->sum('total_harga');

        $pdf = \PDF::loadView('laporan.pdf', compact('laporan', 'totalPendapatan', 'mulai', 'sampai'));
        return $pdf->download('laporan-penjualan.pdf');
    }
}
