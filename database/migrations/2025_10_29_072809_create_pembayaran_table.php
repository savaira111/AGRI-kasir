<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('id_transaksi')->constrained('transaksi_penjualan')->onDelete('cascade');
            $table->string('metode_pembayaran');
            $table->integer('jumlah_bayar');
            $table->integer('kembalian')->default(0);
            $table->timestamp('tanggal_pembayaran')->useCurrent();

            // relasi ke transaksi_penjualan
            $table->foreign('id_transaksi')
                  ->references('id_transaksi')
                  ->on('transaksi_penjualan')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
