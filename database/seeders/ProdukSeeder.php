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
            ['kategori_produk' => 'Insektisida', 'harga_jual' => 35000, 'stok_produk' => 25]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Dithane M-45'],
            ['kategori_produk' => 'Fungisida', 'harga_jual' => 30000, 'stok_produk' => 20]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Roundup 480 SL'],
            ['kategori_produk' => 'Herbisida', 'harga_jual' => 45000, 'stok_produk' => 15]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Nordox 75 WG'],
            ['kategori_produk' => 'Bakterisida', 'harga_jual' => 40000, 'stok_produk' => 10]
        );

        // Pupuk
        Produk::updateOrCreate(
            ['nama_produk' => 'Urea 50kg'],
            ['kategori_produk' => 'Pupuk Kimia', 'harga_jual' => 180000, 'stok_produk' => 8]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'NPK Mutiara 16-16-16'],
            ['kategori_produk' => 'Pupuk Kimia', 'harga_jual' => 220000, 'stok_produk' => 6]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Pupuk Kandang'],
            ['kategori_produk' => 'Pupuk Organik', 'harga_jual' => 25000, 'stok_produk' => 20]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Bayfolan'],
            ['kategori_produk' => 'Pupuk Daun', 'harga_jual' => 35000, 'stok_produk' => 12]
        );

        // ZPT
        Produk::updateOrCreate(
            ['nama_produk' => 'Atonik 100cc'],
            ['kategori_produk' => 'ZPT', 'harga_jual' => 18000, 'stok_produk' => 30]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Rootone F'],
            ['kategori_produk' => 'ZPT', 'harga_jual' => 20000, 'stok_produk' => 25]
        );

        // Media tanam
        Produk::updateOrCreate(
            ['nama_produk' => 'Cocopeat 1kg'],
            ['kategori_produk' => 'Media Tanam', 'harga_jual' => 12000, 'stok_produk' => 40]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Sekam Bakar 5kg'],
            ['kategori_produk' => 'Media Tanam', 'harga_jual' => 20000, 'stok_produk' => 30]
        );

        // Alat pertanian
        Produk::updateOrCreate(
            ['nama_produk' => 'Sprayer 2L'],
            ['kategori_produk' => 'Alat Pertanian', 'harga_jual' => 85000, 'stok_produk' => 10]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Sarung Tangan Karet'],
            ['kategori_produk' => 'Alat Pertanian', 'harga_jual' => 15000, 'stok_produk' => 50]
        );
        Produk::updateOrCreate(
            ['nama_produk' => 'Gunting Tanaman'],
            ['kategori_produk' => 'Alat Pertanian', 'harga_jual' => 25000, 'stok_produk' => 25]
        );
    }
}
