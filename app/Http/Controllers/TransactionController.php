<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaksi;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transaksi = Transaction::orderBy('tanggal_transaksi', 'desc')
            ->with('user')
            ->get();

        return view('transactions.index', compact('transaksi'));
    }

    public function create()
    {
        $users = User::all();
        $produk = Produk::all();

        return view('transactions.create', compact('users', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'total_harga' => 'required|numeric|min:1',
            'produk_id' => 'required|array|min:1',
            'jumlah' => 'required|array',
            'jumlah.*' => 'numeric|min:1',
            'metode_pembayaran' => 'required|in:cash,transfer',
        ]);

        DB::beginTransaction();

        try {

            // SIMPAN TRANSAKSI UTAMA
            $transaksi = Transaction::create([
                'id_user' => $request->id_user,
                'tanggal_transaksi' => now(),
                'total_harga' => $request->total_harga,
                'metode_pembayaran' => $request->metode_pembayaran,
            ]);

            // SIMPAN DETAIL TRANSAKSI
            foreach ($request->produk_id as $i => $id_produk) {

                $jumlah = (int)$request->jumlah[$i];
                $produk = Produk::findOrFail($id_produk);

                if ($produk->stok < $jumlah) {
                    throw new \Exception("Stok produk {$produk->nama_produk} tidak mencukupi!");
                }

                $subtotal = $jumlah * $produk->harga_jual;

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id,
                    'id_produk' => $id_produk,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ]);

                // KURANGI STOK
                $produk->stok -= $jumlah;
                $produk->save();
            }

            DB::commit();

            return redirect()->route('transactions.index')
                ->with('success', 'Transaksi berhasil dibuat!');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $transaksi = Transaction::with(['user', 'detailTransaksi.produk'])->findOrFail($id);
        return view('transactions.show', compact('transaksi'));
    }

    public function destroy($id)
    {
        $transaksi = Transaction::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }

    public function search(Request $request)
    {
        $keyword = $request->q;
        $produk = Produk::where('nama_produk', 'like', '%' . $keyword . '%')->get();

        return response()->json($produk);
    }
}
