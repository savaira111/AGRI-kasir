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
            $table->unsignedBigInteger('id_transaksi');
            // foreign key ke transaksi_penjualan.id
            $table->foreign('id_transaksi')
                  ->references('id')
                  ->on('transaksi')
                  ->cascadeOnDelete();

            $table->string('metode_pembayaran');
            $table->integer('jumlah_bayar');
            $table->integer('kembalian')->default(0);
            $table->timestamp('tanggal_pembayaran')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
