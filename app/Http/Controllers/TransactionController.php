<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;

class TransactionController extends Controller
{
    // 🔹 Tampilkan semua transaksi
    public function index()
    {
        $transactions = Transaction::orderBy('tanggal_transaksi', 'desc')
            ->with('user') // relasi user kalau ada
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    // 🔹 Form tambah transaksi
    public function create()
    {
        $users = User::all(); // pilih user kasir/admin
        return view('transactions.create', compact('users'));
    }

    // 🔹 Simpan transaksi
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'tanggal_transaksi' => 'required|date',
            'total_harga' => 'required|numeric|min:0',
            'status' => 'required',
            'metode_pembayaran' => 'required|string',
        ]);

        // Simpan
        Transaction::create([
            'id_user' => $request->id_user,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'total_harga' => $request->total_harga,
            'status' => 'selesai', // default
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dibuat!');
    }

    // 🔹 Detail transaksi
    public function show($id)
    {
        $transaction = Transaction::with(['user'])
            ->findOrFail($id);

        return view('transactions.show', compact('transaction'));
    }

    // 🔹 Hapus transaksi
    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
