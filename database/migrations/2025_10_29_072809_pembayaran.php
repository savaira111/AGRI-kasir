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
            $table->string('metode_pembayaran'); // contoh: Tunai
            $table->decimal('total_bayar', 10, 2);
            $table->decimal('kembalian', 10, 2)->default(0);
            $table->timestamps();

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
