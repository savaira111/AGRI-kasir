<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Produk;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //  Menampilkan semua transaksi
    public function index()
    {
        $transaksi = Transaksi::with('detailTransaksi.produk')->get();
        return view('transaksi.index', compact('transaksi'));
    }

    //  Form transaksi baru
    public function create()
    {
        $produk = Produk::where('status_produk', 'aktif')->get();
        return view('transaksi.create', compact('produk'));
    }

    //  Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|array',
            'qty' => 'required|array',
        ]);

        $total = 0;
        foreach ($request->produk_id as $index => $id_produk) {
            $produk = Produk::find($id_produk);
            $total += $produk->harga_jual * $request->qty[$index];
        }

        // Simpan transaksi utama
        $transaksi = Transaksi::create([
            'tanggal_transaksi' => now(),
            'total_harga' => $total,
            'id_user' => auth()->id(), // id kasir
            'status' => 'Belum Lunas',
        ]);

        // Simpan detail transaksi
        foreach ($request->produk_id as $index => $id_produk) {
            $produk = Produk::find($id_produk);

            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id_transaksi,
                'id_produk' => $id_produk,
                'jumlah' => $request->qty[$index],
                'subtotal' => $produk->harga_jual * $request->qty[$index],
            ]);

            // Kurangi stok
            $produk->stok -= $request->qty[$index];
            $produk->save();
        }

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibuat!');
    }

    //  Detail transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with('detailTransaksi.produk')->findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    //  Hapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi dihapus!');
    }
}
