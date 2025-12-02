<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPenjualan;
use App\Models\Transaction;
use Carbon\Carbon;

class LaporanPenjualanController extends Controller
{
    // ============================
    // TAMPILKAN LIST LAPORAN
    // ============================
    public function index(Request $request)
    {
        $laporanList = LaporanPenjualan::orderBy('id_laporan', 'desc')->get();

        // Ringkasan laporan terakhir
        $laporanTerakhir = LaporanPenjualan::orderBy('id_laporan', 'desc')->first();

        $filterBulan = $request->input('bulan');
        $filterTahun = $request->input('tahun');

        return view('laporan.index', [
            'laporanList' => $laporanList,
            'laporanTerakhir' => $laporanTerakhir,
            'filterBulan' => $filterBulan,
            'filterTahun' => $filterTahun,
        ]);
    }

    // ============================
    // GENERATE LAPORAN BULANAN MANUAL
    // ============================
    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000',
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $periode = Carbon::createFromDate($tahun, $bulan, 1)->format('F Y');

        // Ambil total penjualan dan transaksi dari tabel transaksi
        $totalPenjualan = Transaction::whereMonth('created_at', $bulan)
                            ->whereYear('created_at', $tahun)
                            ->sum('total_harga');

        $totalTransaksi = Transaction::whereMonth('created_at', $bulan)
                            ->whereYear('created_at', $tahun)
                            ->count();

        // updateOrCreate agar tidak duplicate laporan
        LaporanPenjualan::updateOrCreate(
            ['periode' => $periode],
            [
                'total_penjualan' => $totalPenjualan,
                'total_transaksi' => $totalTransaksi,
            ]
        );

        return redirect()->route('laporan.index')->with('success', "Laporan untuk periode $periode berhasil dibuat!");
    }

    // ============================
    // EXPORT PDF LAPORAN
    // ============================
    public function exportPdf($id_laporan)
    {
        $laporan = LaporanPenjualan::findOrFail($id_laporan);

        $pdf = \PDF::loadView('laporan.pdf', compact('laporan'));
        return $pdf->download('Laporan-' . $laporan->periode . '.pdf');
    }

    // ============================
    // UPDATE LAPORAN OTOMATIS SETELAH TRANSAKSI
    // ============================
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
