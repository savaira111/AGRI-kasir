<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran');

            // FK BENAR
            $table->unsignedBigInteger('id_transaksi');

            $table->string('metode_pembayaran');
            $table->integer('jumlah_bayar');
            $table->integer('kembalian')->default(0);
            $table->timestamp('tanggal_pembayaran')->useCurrent();

            // FOREIGN KEY FIX
            $table->foreign('id_transaksi')
                  ->references('id_transaksi')         // kolom tujuan
                  ->on('transaksi_penjualan')          // tabel tujuan
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
