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
        $year = date('y');
        $month = date('m');

        $prefix = "PRD{$year}{$month}";

        $lastProduct = Produk::where('kode_produk', 'LIKE', $prefix . '%')
                        ->orderBy('kode_produk', 'desc')
                        ->first();

        $nextNumber = $lastProduct ? intval(substr($lastProduct->kode_produk, -3)) + 1 : 1;

        $kodeOtomatis = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $satuan = ['Kg', 'Liter', 'Pcs', 'Pack', 'Botol'];
        $tanggalHariIni = date('d-m-Y');

        return view('kelola.tambah-produk', compact('kodeOtomatis', 'satuan', 'tanggalHariIni'));
    }

    // 🌿 Simpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'nullable|string|max:100',
            'nama_produk' => 'required|string|max:255',
            'nama_pemasok' => 'nullable|string|max:255',
            'stok_produk' => 'required|integer|min:0',
            'harga_jual' => 'nullable|numeric|min:0',  // decimal support
            'harga_beli' => 'nullable|numeric|min:0',  // decimal support
            'kategori_produk' => 'nullable|string|max:100',
            'satuan_produk' => 'nullable|string|max:50',
            'foto_produk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi_produk' => 'nullable|string',
            'tanggal_input' => 'nullable|date',
            'tanggal_kadaluarsa' => 'nullable|date|after_or_equal:tanggal_input',
        ]);

        $produk = new Produk();

        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $namaFile = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->storeAs('produk', $namaFile, 'public');
            $produk->foto_produk = 'produk/'.$namaFile;
        }

        $produk->kode_produk = $request->kode_produk;
        $produk->nama_produk = $request->nama_produk;
        $produk->nama_pemasok = $request->nama_pemasok;
        $produk->stok_produk = $request->stok_produk;
        $produk->harga_jual = $request->harga_jual;
        $produk->harga_beli = $request->harga_beli;
        $produk->kategori_produk = $request->kategori_produk;
        $produk->satuan_produk = $request->satuan_produk;
        $produk->deskripsi_produk = $request->deskripsi_produk;
        $produk->tanggal_input = $request->tanggal_input;
        $produk->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;

        $produk->save();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 🌿 Edit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        $year = date('y');
        $month = date('m');
        $prefix = "PRD{$year}{$month}";

        $lastProduct = Produk::where('kode_produk', 'LIKE', $prefix . '%')
                        ->orderBy('kode_produk', 'desc')
                        ->first();

        $nextNumber = $lastProduct ? intval(substr($lastProduct->kode_produk, -3)) + 1 : 1;

        $kodeOtomatis = $prefix . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        $satuan = ['Kg', 'Liter', 'Pcs', 'Pack', 'Botol'];
        $tanggalHariIni = date('d-m-Y');

        return view('kelola.edit-produk', compact('produk', 'kodeOtomatis', 'satuan', 'tanggalHariIni'));
    }

    // 🌿 UPDATE PRODUK
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk'         => 'required|string|max:100',
            'tanggal_input'       => 'required|date',
            'nama_produk'         => 'required|string|max:255',
            'nama_pemasok'        => 'required|string|max:255',
            'kategori_produk'     => 'required|string|max:100',
            'stok_produk'         => 'required|integer|min:0',
            'satuan_produk'       => 'required|string|max:50',
            'harga_jual'          => 'required|numeric|min:0',  // decimal support
            'harga_beli'          => 'required|numeric|min:0',  // decimal support
            'deskripsi_produk'    => 'nullable|string',
            'tanggal_kadaluarsa'  => 'required|date|after_or_equal:tanggal_input',
            'foto_produk'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        $produk->kode_produk        = $request->kode_produk;
        $produk->tanggal_input      = $request->tanggal_input;
        $produk->nama_produk        = $request->nama_produk;
        $produk->nama_pemasok       = $request->nama_pemasok;
        $produk->kategori_produk    = $request->kategori_produk;
        $produk->stok_produk        = $request->stok_produk;
        $produk->satuan_produk      = $request->satuan_produk;
        $produk->harga_jual         = $request->harga_jual;
        $produk->harga_beli         = $request->harga_beli;
        $produk->deskripsi_produk   = $request->deskripsi_produk;
        $produk->tanggal_kadaluarsa = $request->tanggal_kadaluarsa;

        // Foto tetap bisa update
        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $file = $request->file('foto_produk');
            $namaFile = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->storeAs('produk', $namaFile, 'public');
            $produk->foto_produk = 'produk/'.$namaFile;
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
