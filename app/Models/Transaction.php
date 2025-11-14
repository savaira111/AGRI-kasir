<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiPenjualan;
use App\Models\DetailTransaksi;
use App\Models\Produk;

class TransactionController extends Controller
{
    // Display all sales transactions
    public function index()
    {
        $transactions = TransaksiPenjualan::with(['user', 'detailTransaksi.produk'])
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    // Show form to create a new transaction
    public function create()
    {
        $products = Produk::all();
        return view('transactions.create', compact('products'));
    }

    // Store new transaction
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'produk_id' => 'required|array',
            'produk_id.*' => 'exists:produk,id_produk',
            'quantity.*' => 'required|integer|min:1'
        ]);

        $transaction = TransaksiPenjualan::create([
            'id_user' => $request->id_user,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'status' => $request->status,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_harga' => 0, // temporary, will calculate below
        ]);

        $total = 0;
        foreach ($request->produk_id as $index => $produkId) {
            $product = Produk::find($produkId);
            $quantity = $request->quantity[$index];
            $subtotal = $product->harga * $quantity;
            $total += $subtotal;

            DetailTransaksi::create([
                'id_transaksi' => $transaction->id_transaksi,
                'id_produk' => $produkId,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);
        }

        $transaction->update(['total_harga' => $total]);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
    }

    // Show a single transaction
    public function show($id)
    {
        $transaction = TransaksiPenjualan::with(['user', 'detailTransaksi.produk', 'pembayaran'])
            ->findOrFail($id);

        return view('transactions.show', compact('transaction'));
    }

    // Delete transaction
    public function destroy($id)
    {
        $transaction = TransaksiPenjualan::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
