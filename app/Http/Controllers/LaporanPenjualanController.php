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
    //  TAMPILKAN LIST LAPORAN + RINGKASAN PERIODE TERAKHIR
    // ======================================================
    public function index(Request $request)
    {
        // Ambil semua laporan, urut dari terbaru
        $laporanList = LaporanPenjualan::with('pembuat')
                            ->orderBy('created_at', 'DESC')
                            ->get();

        // Ambil laporan terakhir (periode terbaru) untuk ringkasan
        $laporanTerakhir = $laporanList->first();

        return view('laporan.index', compact('laporanList', 'laporanTerakhir'));
    }

    // ======================================================
    //  GENERATE LAPORAN BARU
    // ======================================================
    public function generate(Request $request)
    {
        $request->validate([
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2000'
        ]);

        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $transaksi = Transaction::whereMonth('tanggal_transaksi', $bulan)
                                ->whereYear('tanggal_transaksi', $tahun)
                                ->get();

        if ($transaksi->count() < 1) {
            return back()->with('error', 'Tidak ada transaksi di periode tersebut.');
        }

        $totalPenjualan = $transaksi->sum('total_harga');
        $totalTransaksi = $transaksi->count();

        $periode = $bulan . '-' . $tahun;

        $existing = LaporanPenjualan::where('periode', $periode)->first();

        if ($existing) {
            $existing->update([
                'total_penjualan' => $totalPenjualan,
                'total_transaksi' => $totalTransaksi,
                'dibuat_oleh'    => Auth::id()
            ]);

            return back()->with('success', 'Laporan periode tersebut sudah ada. Data berhasil diperbarui.');
        }

        LaporanPenjualan::create([
            'periode'         => $periode,
            'total_penjualan' => $totalPenjualan,
            'total_transaksi' => $totalTransaksi,
            'dibuat_oleh'     => Auth::id()
        ]);

        return back()->with('success', 'Laporan berhasil dibuat.');
    }

    // ======================================================
    //  EXPORT PDF LAPORAN
    // ======================================================
    public function exportPdf($id)
    {
        $laporan = LaporanPenjualan::findOrFail($id);

        [$bulan, $tahun] = explode('-', $laporan->periode);

        $transaksi = Transaction::whereMonth('tanggal_transaksi', $bulan)
                                ->whereYear('tanggal_transaksi', $tahun)
                                ->get();

        $pdf = PDF::loadView('laporan.pdf', [
            'laporan'   => $laporan,
            'transaksi' => $transaksi
        ])->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Penjualan_' . $laporan->periode . '.pdf');
    }
}
