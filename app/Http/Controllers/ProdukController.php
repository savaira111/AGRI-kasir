<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // 🌿 Tampilkan semua produk
    public function index()
    {
        $produk = Produk::all();
        return view('kelola.produk', compact('produk'));
    }

    // 🌿 Form tambah produk
    public function create()
    {
        return view('kelola.tambah-produk');
    }

    // 🌿 Simpan produk baru
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'kode_produk' => 'required|unique:produk,kode_produk',
            'nama_produk' => 'required|string|max:255',
            'nama_pemasok' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|numeric|min:0',
            'satuan' => 'required' ,
            'harga_jual' => 'required' ,
            'harga_beli' => 'required' ,
            'deskripsi_produk' => 'required' ,
            'tanggal_input' => 'required' ,
            'tanggal_kadaluarsa' => 'required' ,
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_produk')) {
            $validated['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        }

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 🌿 Form edit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('kelola.edit-produk', compact('produk'));
    }

    // 🌿 Update data produk
    public function update(Request $request, $id)
    {
        // dd($request);
        $produk = Produk::findOrFail($id);

        $validated = $request->validate([
            'kode_produk' => 'nullable|unique:produk,kode_produk,' . $produk->id,
            'nama_produk' => 'nullable|string|max:255',
            'nama_pemasok' => 'nullable|string|max:255',
            'kategori_produk' => 'nullable|string|max:255',
            'stok' => 'nullable|numeric|min:0',
            'satuan' => 'nullable' ,
            'harga_jual' => 'nullable' ,
            'harga_beli' => 'nullable' ,
            'deskripsi_produk' => 'nullable' ,
            'tanggal_input' => 'nullable' ,
            'tanggal_kadaluarsa' => 'nullable' ,
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 🌸 Jika ada file baru, hapus foto lama dan simpan yang baru
        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $validated['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // 🌿 Hapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto_produk) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }


public function show($id)
{
    $produk = Produk::findOrFail($id);
    return view('kelola.detail-produk', compact('produk'));
}
}