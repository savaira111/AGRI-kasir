<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        Transaction::create([
            'id' => 1,
            'id_user' => 1, 
            'tanggal_transaksi' => now(),
            'total_harga' => 70000,
            'status' => 'selesai',
            'metode_pembayaran' => 'cash',
        ]);

        Transaction::create([
            'id' => 2,
            'id_user' => 1,
            'tanggal_transaksi' => now(),
            'total_harga' => 120000,
            'status' => 'selesai',
            'metode_pembayaran' => 'cash',
        ]);
    }
}
