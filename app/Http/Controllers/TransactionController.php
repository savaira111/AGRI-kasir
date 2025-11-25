<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaksi;
use App\Models\User;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // 🌿 Tampilkan daftar transaksi + search
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Transaction::with('user')
            ->orderBy('tanggal_transaksi', 'desc')
            ->orderBy('id', 'desc');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%$search%")
                  ->orWhere('tanggal_transaksi', 'like', "%$search%")
                  ->orWhere('total_harga', 'like', "%$search%")
                  ->orWhere('metode_pembayaran', 'like', "%$search%")
                  ->orWhereHas('user', function($q2) use ($search) {
                      // pakai kolom yang ada di users, misal 'name'
                      $q2->where('name', 'like', "%$search%");
                  });
            });
        }

        $transaksi = $query->paginate(10); // pagination

        return view('transactions.index', compact('transaksi', 'search'));
    }

    // 🌿 Form tambah transaksi
    public function create()
    {
        $users = User::all();
        $produk = Produk::all();

        return view('transactions.create', compact('users', 'produk'));
    }

    // 🌿 Simpan transaksi
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'total_harga' => 'required|numeric|min:1',
            'produk_id' => 'required|array|min:1',
            'metode_pembayaran' => 'required|in:cash,qris',
            'bayar' => 'nullable|numeric|min:0',
            'kembalian' => 'nullable|numeric|min:0',
            'qris_image_url' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $bayar = null;
            $kembalian = null;

            if ($request->metode_pembayaran == 'cash') {
                if ($request->bayar < $request->total_harga) {
                    return back()->with('error', 'Bayar kurang dari total harga!');
                }
                $bayar = $request->bayar;
                $kembalian = $request->bayar - $request->total_harga;
            }

            $transaksi = Transaction::create([
                'id_user' => $request->id_user,
                'tanggal_transaksi' => now(),
                'total_harga' => $request->total_harga,
                'metode_pembayaran' => $request->metode_pembayaran,
                'bayar' => $bayar,
                'kembalian' => $kembalian,
                'qris_image_url' => $request->qris_image_url ?? null,
            ]);

            foreach ($request->produk_id as $i => $id_produk) {
                $jumlah = (int)$request->jumlah[$i];
                $produk = Produk::findOrFail($id_produk);
                $subtotal = $jumlah * $produk->harga_jual;

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'id_produk' => $id_produk,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ]);

                // update stok produk, jangan minus
                $produk->stok_produk = max(0, $produk->stok_produk - $jumlah);
                $produk->save();
            }

            DB::commit();

            return redirect()->route('transactions.show', $transaksi->id)
                ->with('success', 'Transaksi berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    // 🌿 Tampilkan detail transaksi
    public function show($id)
    {
        $transaksi = Transaction::with(['user', 'detailTransaksi.produk'])->findOrFail($id);
        return view('transactions.show', compact('transaksi'));
    }

    // 🌿 Hapus transaksi
    public function destroy($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }

    // 🌿 Generate PDF struk transaksi
    public function pdf($id)
    {
        $transaksi = Transaction::with('detailTransaksi.produk', 'user')->findOrFail($id);

        $pdf = Pdf::loadView('transactions.pdf', compact('transaksi'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('struk-transaksi-'.$transaksi->id.'.pdf');
    }
}
