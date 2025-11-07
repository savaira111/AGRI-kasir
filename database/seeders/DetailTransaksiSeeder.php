<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailTransaksi;

class DetailTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        // Detail transaksi untuk transaksi 1
        DetailTransaksi::updateOrCreate(
            ['id_transaksi' => 1, 'id_produk' => 1],
            ['jumlah' => 1, 'subtotal' => 40000]
        );

        DetailTransaksi::updateOrCreate(
            ['id_transaksi' => 1, 'id_produk' => 2],
            ['jumlah' => 1, 'subtotal' => 30000]
        );

        // Detail transaksi untuk transaksi 2
        DetailTransaksi::updateOrCreate(
            ['id_transaksi' => 2, 'id_produk' => 3],
            ['jumlah' => 2, 'subtotal' => 100000]
        );

        DetailTransaksi::updateOrCreate(
            ['id_transaksi' => 2, 'id_produk' => 1],
            ['jumlah' => 1, 'subtotal' => 20000]
        );
    }
}
