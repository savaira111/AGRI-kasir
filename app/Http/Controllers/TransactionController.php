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
        // VALIDASI
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'total_harga' => 'required|numeric|min:1',
            'produk_id' => 'required|array|min:1',
            'metode_pembayaran' => 'required|in:cash,qris',
            'bayar' => 'nullable|numeric|min:0',
            'kembalian' => 'nullable|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {

            // HITUNG KEMBALIAN (Jika cash)
            $kembalian = 0;

            if ($request->metode_pembayaran == 'cash') {
                $kembalian = $request->bayar - $request->total_harga;

            }

            // SIMPAN TRANSAKSI UTAMA
            $transaksi = Transaction::create([
                'id_user'            => $request->id_user,
                'tanggal_transaksi'  => now(),
                'total_harga'        => $request->total_harga,
                'metode_pembayaran'  => $request->metode_pembayaran,
                'bayar'              => $request->bayar,
                'kembalian'          => $kembalian,
            ]);

            // SIMPAN DETAIL TRANSAKSI
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

                // KURANGI STOK
                $produk->stok_produk -= $jumlah;
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

       public function pdf($id)
    {
        $transaksi = Transaction::with('detailTransaksi.produk', 'user')->findOrFail($id);

        $pdf = Pdf::loadView('transactions.pdf', compact('transaksi'))
                ->setPaper('a4', 'portrait');

        return $pdf->download('struk-transaksi-'.$transaksi->id.'.pdf');
    }

}
