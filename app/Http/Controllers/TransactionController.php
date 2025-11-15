<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaksi;
use App\Models\Pembayaran;
use App\Models\CetakStruk;


class TransactionController extends Controller
{
    // Menampilkan semua transaksi
    public function index()
    {
        // Ambil semua transaksi sekaligus relasi user, detail, pembayaran, dan struk
        $transactions = Transaction::with(['user', 'detailTransaksi', 'pembayaran', 'struk'])
                            ->orderBy('tanggal_transaksi', 'desc')
                            ->get();

        return view('transactions.index', compact('transactions'));
    }

    // Menampilkan form tambah transaksi
    public function create()
    {
        return view('transactions.create');
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        // validasi bisa ditambah nanti
        $transaction = Transaction::create([
            'id_user' => $request->id_user,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'total_harga' => $request->total_harga,
            'status' => $request->status,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
    }

    // Detail transaksi
    public function show($id)
    {
        $transaction = Transaction::with(['user', 'detailTransaksi', 'pembayaran', 'struk'])
                            ->findOrFail($id);

        return view('transactions.show', compact('transaction'));
    }

    // Hapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
