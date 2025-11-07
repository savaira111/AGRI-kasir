<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    //  Menampilkan semua produk
    public function index()
    {
        $produk = Produk::all(); // ambil semua data produk
        return view('produk.index', compact('produk'));
    }

    //  Form tambah produk baru
    public function create()
    {
        return view('produk.create');
    }

    //  Simpan produk baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:100',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi_produk' => 'nullable|string',
        ]);

        // Upload foto (kalau ada)
        $fotoPath = null;
        if ($request->hasFile('foto_produk')) {
            $fotoPath = $request->file('foto_produk')->store('foto_produk', 'public');
        }

        // Simpan produk
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'foto_produk' => $fotoPath,
            'deskripsi_produk' => $request->deskripsi_produk,
            'status_produk' => 'aktif',
            'tanggal_input' => now(),
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    //  Form edit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', compact('produk'));
    }

    //  Update data produk
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:100',
            'kategori' => 'nullable|string|max:100',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|integer',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi_produk' => 'nullable|string',
        ]);

        // Upload foto baru (kalau ada)
        if ($request->hasFile('foto_produk')) {
            $fotoPath = $request->file('foto_produk')->store('foto_produk', 'public');
            $produk->foto_produk = $fotoPath;
        }

        // Update data produk
        $produk->update([
            'nama_produk' => $request->nama_produk,
            'kategori' => $request->kategori,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'deskripsi_produk' => $request->deskripsi_produk,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    //  Hapus produk dari database
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}
