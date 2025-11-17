<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk'); // Primary Key
            $table->string('kode_produk')->nullable(); // Kode unik (opsional)
            $table->string('nama_produk'); // Nama barang
            $table->string('nama_pemasok')->nullable();
            $table->integer('stok_produk')->default(0); // Jumlah stok
            $table->decimal('harga_jual', 10, 2)->nullable(); // Harga jual
            $table->decimal('harga_beli', 10, 2)->nullable(); // Harga beli
            $table->string('kategori_produk')->nullable(); // Contoh: Pupuk, Obat, Alat Pertanian
            $table->string('satuan_produk')->nullable(); // kg, liter, pcs
            $table->string('foto_produk')->nullable(); // Nama file gambar
            $table->text('deskripsi_produk')->nullable(); // Deskripsi tambahan
            $table->string('status_produk')->default('aktif'); // aktif / nonaktif
            $table->date('tanggal_input')->nullable(); // Tanggal barang masuk
            $table->date('tanggal_kadaluarsa')->nullable(); // Kadaluarsa (kalau ada)
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
