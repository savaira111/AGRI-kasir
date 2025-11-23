<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class LaporanPenjualanController extends Controller
{
    // ======================================================
    //  TAMPILKAN LIST LAPORAN + FILTER PERIODE
    // ======================================================
    public function index(Request $request)
    {
        $periode = $request->periode;

        $query = LaporanPenjualan::with('pembuat');

        if ($periode) {
            $query->where('periode', $periode);
        }

        $laporan = $query->orderBy('created_at', 'DESC')->get();

        return view('laporan.index', compact('laporan', 'periode'));
    }


    // ======================================================
    //  GENERATE LAPORAN BARU (BERDASARKAN TRANSAKSI)
    // ======================================================
    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required',
            'tahun' => 'required'
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        // Ambil transaksi berdasarkan bulan & tahun
        $transaksi = Transaction::whereMonth('tanggal_transaksi', $bulan)
                                ->whereYear('tanggal_transaksi', $tahun)
                                ->get();

        if ($transaksi->count() < 1) {
            return back()->with('error', 'Tidak ada transaksi di periode tersebut.');
        }

        $totalPenjualan = $transaksi->sum('total_harga');
        $totalLaba = $transaksi->sum('total_laba');
        $totalTransaksi = $transaksi->count();

        // Format periode: "11-2025"
        $periode = $bulan . '-' . $tahun;

        // Simpan ke tabel laporan
        LaporanPenjualan::create([
            'periode'          => $periode,
            'total_penjualan'  => $totalPenjualan,
            'total_transaksi'  => $totalTransaksi,
            'total_laba'       => $totalLaba,
            'dibuat_oleh'      => Auth::id()
        ]);

        return back()->with('success', 'Laporan berhasil dibuat.');
    }


    // ======================================================
    //  EXPORT PDF LAPORAN
    // ======================================================
    public function exportPdf($id)
    {
        $laporan = LaporanPenjualan::findOrFail($id);

        $pdf = PDF::loadView('laporan.pdf', [
            'laporan' => $laporan
        ])->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Penjualan' . $laporan->periode . '.pdf');
    }
}
