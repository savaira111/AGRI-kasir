<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Obat-obatan tanaman
        Produk::updateOrCreate(
            ['nama_produk' => 'Decis 25 EC'],
            ['kategori' => 'Insektisida', 'harga_jual' => 35000, 'stok' => 25]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Dithane M-45'],
            ['kategori' => 'Fungisida', 'harga_jual' => 30000, 'stok' => 20]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Roundup 480 SL'],
            ['kategori' => 'Herbisida', 'harga_jual' => 45000, 'stok' => 15]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Nordox 75 WG'],
            ['kategori' => 'Bakterisida', 'harga_jual' => 40000, 'stok' => 10]
        );

        // Pupuk
        Produk::updateOrCreate(
            ['nama_produk' => 'Urea 50kg'],
            ['kategori' => 'Pupuk Kimia', 'harga_jual' => 180000, 'stok' => 8]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'NPK Mutiara 16-16-16'],
            ['kategori' => 'Pupuk Kimia', 'harga_jual' => 220000, 'stok' => 6]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Pupuk Kandang'],
            ['kategori' => 'Pupuk Organik', 'harga_jual' => 25000, 'stok' => 20]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Bayfolan'],
            ['kategori' => 'Pupuk Daun', 'harga_jual' => 35000, 'stok' => 12]
        );

        // ZPT
        Produk::updateOrCreate(
            ['nama_produk' => 'Atonik 100cc'],
            ['kategori' => 'ZPT', 'harga_jual' => 18000, 'stok' => 30]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Rootone F'],
            ['kategori' => 'ZPT', 'harga_jual' => 20000, 'stok' => 25]
        );

        // Media tanam
        Produk::updateOrCreate(
            ['nama_produk' => 'Cocopeat 1kg'],
            ['kategori' => 'Media Tanam', 'harga_jual' => 12000, 'stok' => 40]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Sekam Bakar 5kg'],
            ['kategori' => 'Media Tanam', 'harga_jual' => 20000, 'stok' => 30]
        );

        // Alat pertanian
        Produk::updateOrCreate(
            ['nama_produk' => 'Sprayer 2L'],
            ['kategori' => 'Alat Pertanian', 'harga_jual' => 85000, 'stok' => 10]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Sarung Tangan Karet'],
            ['kategori' => 'Alat Pertanian', 'harga_jual' => 15000, 'stok' => 50]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Gunting Tanaman'],
            ['kategori' => 'Alat Pertanian', 'harga_jual' => 25000, 'stok' => 25]
        );
    }
}
