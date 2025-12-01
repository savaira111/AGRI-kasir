<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk'); 
            $table->string('kode_produk')->nullable();
            $table->string('nama_produk'); 
            $table->string('nama_pemasok')->nullable();
            $table->integer('stok_produk')->default(0); 
            $table->decimal('harga_jual', 15, 2)->nullable()->change; 
            $table->decimal('harga_beli', 15, 2)->nullable()->change; 
            $table->string('kategori_produk')->nullable(); 
            $table->string('satuan_produk')->nullable(); 
            $table->string('foto_produk')->nullable(); 
            $table->text('deskripsi_produk')->nullable(); 
            $table->date('tanggal_input')->nullable(); 
            $table->date('tanggal_kadaluarsa')->nullable(); 
            $table->timestamps(); 
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
