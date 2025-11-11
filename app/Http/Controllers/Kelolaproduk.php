<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; // pastiin kamu punya model Produk

class KelolaProdukController extends Controller
{
    // 🔹 Menampilkan halaman kelola produk
    public function index()
    {
        // Ambil semua data produk dari database
        $produk = Produk::all();

        // Kirim ke tampilan
        return view('kelola_produk', compact('produk'));
    }

    // 🔹 Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produks',
            'nama_produk' => 'required',
            'nama_pemasok' => 'required',
            'kategori' => 'required',
            'stok' => 'required|numeric'
        ]);

        Produk::create($request->all());

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }

    // 🔹 Mengupdate produk
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required',
            'nama_pemasok' => 'required',
            'kategori' => 'required',
            'stok' => 'required|numeric'
        ]);

        $produk->update($request->all());

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    // 🔹 Menghapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
