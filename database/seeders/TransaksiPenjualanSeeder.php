<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransaksiPenjualanSeeder extends Seeder
{
    public function run(): void
    {
        Transaction::updateOrCreate(
            ['id_transaksi' => 1],
            [
                'tanggal_transaksi' => now(),
                'total_harga' => 70000,
                'id_user' => 1, // user satu-satunya
                'metode_pembayaran' => 'cash',
            ]
        );

        Transaction::updateOrCreate(
            ['id_transaksi' => 2],
            [
                'tanggal_transaksi' => now(),
                'total_harga' => 120000,
                'id_user' => 1, // tetap 1 karena cuma ada 1 user
                'metode_pembayaran' => 'cash',
            ]
        );
    }
}
