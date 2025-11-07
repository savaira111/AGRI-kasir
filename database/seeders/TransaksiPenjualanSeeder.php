<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransaksiPenjualan;

class TransaksiPenjualanSeeder extends Seeder
{
    public function run(): void
    {
        // Transaksi pertama
        TransaksiPenjualan::updateOrCreate(
            ['id_transaksi' => 1], 
            [
                'tanggal_transaksi' => now(),
                'total_harga' => 70000,
                'id_user' => 1,
                'metode_pembayaran' => 'cash',
            ]
        );

        // Transaksi kedua
        TransaksiPenjualan::updateOrCreate(
            ['id_transaksi' => 2],
            [
                'tanggal_transaksi' => now(),
                'total_harga' => 120000,
                'id_user' => 2,
                'metode_pembayaran' => 'cash',
            ]
        );
    }
}
