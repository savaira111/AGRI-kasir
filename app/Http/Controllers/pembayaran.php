<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    //  Daftar pembayaran
    public function index()
    {
        $pembayaran = Pembayaran::with('transaksi')->get();
        return view('pembayaran.index', compact('pembayaran'));
    }

    //  Form pembayaran (setelah transaksi)
    public function create($id_transaksi)
    {
        $transaksi = Transaksi::findOrFail($id_transaksi);
        return view('pembayaran.create', compact('transaksi'));
    }

    //  Simpan data pembayaran
    public function store(Request $request)
    {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id_transaksi',
            'jumlah_bayar' => 'required|numeric|min:0',
            'metode_pembayaran' => 'required|string',
        ]);

        $transaksi = Transaksi::findOrFail($request->id_transaksi);
        $kembalian = $request->jumlah_bayar - $transaksi->total_harga;

        Pembayaran::create([
            'id_transaksi' => $request->id_transaksi,
            'tanggal_pembayaran' => now(),
            'jumlah_bayar' => $request->jumlah_bayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'kembalian' => $kembalian,
        ]);

        $transaksi->update(['status' => 'Lunas']);

        return redirect()->route('pembayaran.show', $request->id_transaksi)
                         ->with('success', 'Pembayaran berhasil!');
    }

    //  Detail pembayaran (struk)
    public function show($id_transaksi)
    {
        $pembayaran = Pembayaran::where('id_transaksi', $id_transaksi)->first();
        $transaksi = Transaksi::with('detailTransaksi.produk')->findOrFail($id_transaksi);

        return view('pembayaran.show', compact('pembayaran', 'transaksi'));
    }

    //  Hapus pembayaran
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran dihapus!');
    }
}
