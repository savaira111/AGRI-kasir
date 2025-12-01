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

        // Kalau user pilih periode tertentu → ambil 1 data periode itu
        if ($periode) {
            $laporan = $query->where('periode', $periode)
                            ->orderBy('created_at', 'DESC')
                            ->first(); // << ambil satu
        } 
        else {
            // Kalau tidak filter, ambil laporan terbaru saja
            $laporan = LaporanPenjualan::orderBy('created_at', 'DESC')
                                    ->first(); // << ambil satu
        }

        return view('laporan.index', compact('laporan', 'periode'));
    }

    // ======================================================
    //  GENERATE LAPORAN BARU (TANPA TOTAL LABA)
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

        $totalPenjualan  = $transaksi->sum('total_harga');
        $totalTransaksi  = $transaksi->count();

        // Format periode: "11-2025"
        $periode = $bulan . '-' . $tahun;

        //  CEK APAKAH PERIODE SUDAH ADA
        $existing = LaporanPenjualan::where('periode', $periode)->first();

        if ($existing) {
            
            $existing->update([
                'total_penjualan' => $totalPenjualan,
                'total_transaksi' => $totalTransaksi,
                'dibuat_oleh'     => Auth::id()
            ]);

            return back()->with('success', 'Laporan periode tersebut sudah ada. Data berhasil diperbarui.');
        }

        // Jika belum ada, create baru
        LaporanPenjualan::create([
            'periode'          => $periode,
            'total_penjualan'  => $totalPenjualan,
            'total_transaksi'  => $totalTransaksi,
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

        // Ambil bulan & tahun dari laporan → format: "11-2025"
        [$bulan, $tahun] = explode('-', $laporan->periode);

        // Ambil semua transaksi sesuai bulan & tahun
        $transaksi = Transaction::whereMonth('tanggal_transaksi', $bulan)
                                ->whereYear('tanggal_transaksi', $tahun)
                                ->get();

        // Load ke PDF
        $pdf = PDF::loadView('laporan.pdf', [
            'laporan'    => $laporan,
            'transaksi'  => $transaksi
        ])->setPaper('a4', 'portrait');

        return $pdf->download('Laporan_Penjualan_' . $laporan->periode . '.pdf');
    }
}
