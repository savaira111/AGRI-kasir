<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // 🌿 Tampilkan semua produk + search
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produk = Produk::query();

        if ($search) {
            $produk->where('nama_produk', 'like', "%{$search}%")
                   ->orWhere('deskripsi_produk', 'like', "%{$search}%");
        }

        $produk = $produk->get();

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
        $request->validate([
            'kode_produk' => 'nullable|string|max:100',
            'nama_produk' => 'required|string|max:255',
            'nama_pemasok' => 'nullable|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga_jual' => 'nullable|numeric|min:0',
            'harga_beli' => 'nullable|numeric|min:0',
            'kategori' => 'nullable|string|max:100',
            'satuan' => 'nullable|string|max:50',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi_produk' => 'nullable|string',
            'status_produk' => 'nullable|in:aktif,nonaktif',
            'tanggal_input' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date|after_or_equal:tanggal_input',
        ]);

        // Jika ada file, simpan ke storage/app/public/produk dan simpan nama file ke DB
            $namaFile = null;
            if ($request->hasFile('foto_produk')) {
                $file = $request->file('foto_produk');
                $namaFile = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                // simpan di storage/app/public/produk
                $file->storeAs('public/produk', $namaFile);
            }

        $produk = new Produk();
        $produk->kode_produk = $request->kode_produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->nama_pemasok = $request->nama_pemasok;
        $produk->stok = $request->stok;
        $produk->harga_jual = $request->harga_jual;
        $produk->harga_beli = $request->harga_beli;
        $produk->kategori = $request->kategori;
        $produk->satuan = $request->satuan;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->status_produk = $request->status_produk ?? 'aktif';
        $produk->tanggal_input = $request->tanggal_input;
        $produk->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;

        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('produk', $filename, 'public');
            $produk->foto_produk = 'produk/' . $filename;
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 🌿 Form edit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('kelola.edit-produk', compact('produk'));
    }

    // 🌿 Update produk
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk' => 'nullable|string|max:100',
            'nama_produk' => 'required|string|max:255',
            'nama_pemasok' => 'nullable|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga_jual' => 'nullable|numeric|min:0',
            'harga_beli' => 'nullable|numeric|min:0',
            'kategori' => 'nullable|string|max:100',
            'satuan' => 'nullable|string|max:50',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi_produk' => 'nullable|string',
            'status_produk' => 'nullable|in:aktif,nonaktif',
            'tanggal_input' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date|after_or_equal:tanggal_input',
        ]);


        // Jika upload foto baru
        if ($request->hasFile('foto_produk')) {

        // Hapus foto lama jika ada
        if ($produk->foto_produk && file_exists(storage_path('app/public/produk/' . $produk->foto_produk))) {
            unlink(storage_path('app/public/produk/' . $produk->foto_produk));
        }

        // Simpan foto baru
        $file = $request->file('foto_produk');
        $namaFile = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $file->storeAs('public/produk', $namaFile);

        $produk->foto_produk = $namaFile;
    }

        $produk = Produk::findOrFail($id);

        $produk->kode_produk = $request->kode_produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->nama_pemasok = $request->nama_pemasok;
        $produk->stok = $request->stok;
        $produk->harga_jual = $request->harga_jual;
        $produk->harga_beli = $request->harga_beli;
        $produk->kategori = $request->kategori;
        $produk->satuan = $request->satuan;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->status_produk = $request->status_produk ?? 'aktif';
        $produk->tanggal_input = $request->tanggal_input;
        $produk->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;

        if ($request->hasFile('foto_produk')) {

            // hapus file lama
            if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
                Storage::disk('public')->delete($produk->foto_produk);
            }

            $file = $request->file('foto_produk');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('produk', $filename, 'public');
            $produk->foto_produk = 'produk/' . $filename;
        }

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // 🌿 Hapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    // 🌿 Detail produk
    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('kelola.detail_produk', compact('produk'));
    }

    
}