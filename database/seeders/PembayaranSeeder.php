<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        // Pembayaran untuk Transaksi 1
        Pembayaran::updateOrCreate(
            ['id_transaksi' => 1],
            [
                'metode_pembayaran' => 'cash',
                'jumlah_bayar' => 300000,
                'kembalian' => 50000,
                'tanggal_pembayaran' => Carbon::now(),
            ]
        );

        // Pembayaran untuk Transaksi 2
        Pembayaran::updateOrCreate(
            ['id_transaksi' => 2],
            [
                'metode_pembayaran' => 'cash',
                'jumlah_bayar' => 150000,
                'kembalian' => 0,
                'tanggal_pembayaran' => Carbon::now(),
            ]
        );

        // Pembayaran untuk Transaksi 3
        Pembayaran::updateOrCreate(
            ['id_transaksi' => 3],
            [
                'metode_pembayaran' => 'cash',
                'jumlah_bayar' => 90000,
                'kembalian' => 3000,
                'tanggal_pembayaran' => Carbon::now(),
            ]
        );
    }
}
