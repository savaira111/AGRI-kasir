<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPenjualan;
use App\Models\Transaction;
use Carbon\Carbon;

class LaporanPenjualanController extends Controller
{
    // ============================================
    //  TAMPILKAN HALAMAN LAPORAN
    // ============================================
    public function index(Request $request)
    {
        $laporanList = LaporanPenjualan::orderBy('id_laporan', 'desc')->get();
        $laporanTerakhir = LaporanPenjualan::orderBy('id_laporan', 'desc')->first();

        return view('laporan.index', [
            'laporanList'   => $laporanList,
            'laporanTerakhir' => $laporanTerakhir,
            'filterBulan'   => $request->bulan,
            'filterTahun'   => $request->tahun,
            'isGenerated'   => false,   // ⬅ default
        ]);
    }

    // ============================================
    //  GENERATE LAPORAN MANUAL
    // ============================================
    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $periode = Carbon::createFromDate($tahun, $bulan, 1)->format('F Y');

        // Hitung nilai laporan
        $totalPenjualan = Transaction::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->sum('total_harga');

        $totalTransaksi = Transaction::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->count();

        // Simpan/update laporan
        LaporanPenjualan::updateOrCreate(
            ['periode' => $periode],
            [
                'total_penjualan' => $totalPenjualan,
                'total_transaksi' => $totalTransaksi,
            ]
        );

        // Re-fetch setelah insert/update
        $laporanList = LaporanPenjualan::orderBy('id_laporan', 'desc')->get();
        $laporanTerakhir = LaporanPenjualan::orderBy('id_laporan', 'desc')->first();

        // RETURN TIDAK REDIRECT (fix utama)
        return view('laporan.index', [
            'laporanList'     => $laporanList,
            'laporanTerakhir' => $laporanTerakhir,
            'filterBulan'     => $bulan,
            'filterTahun'     => $tahun,
            'isGenerated'     => true,     // ⬅ penanda agar tampilan berubah
        ])->with('success', "Laporan untuk periode $periode berhasil dibuat!");
    }

    // ============================================
    //  EXPORT PDF
    // ============================================
    public function exportPdf($id_laporan)
    {
        $laporan = LaporanPenjualan::findOrFail($id_laporan);

        // Ambil transaksi sesuai periode laporan
        $bulan = Carbon::parse($laporan->periode)->format('m');
        $tahun = Carbon::parse($laporan->periode)->format('Y');

        $transaksi = Transaction::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        $pdf = \PDF::loadView('laporan.pdf', [
            'laporan' => $laporan,
            'transaksi' => $transaksi
        ]);

        return $pdf->download('Laporan-' . $laporan->periode . '.pdf');
    }

    // ============================================
    //  UPDATE LAPORAN OTOMATIS KETIKA ADA TRANSAKSI
    // ============================================
    public static function updateLaporanAfterTransaction(Transaction $transaction)
    {
        $periode = Carbon::parse($transaction->created_at)->format('F Y');

        $laporan = LaporanPenjualan::firstOrCreate(
            ['periode' => $periode],
            ['total_penjualan' => 0, 'total_transaksi' => 0]
        );

        $laporan->total_penjualan += $transaction->total_harga;
        $laporan->total_transaksi += 1;
        $laporan->save();
    }
}