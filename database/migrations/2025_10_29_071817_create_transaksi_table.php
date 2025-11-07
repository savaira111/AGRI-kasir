<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi_penjualan', function (Blueprint $table) {
            $table->id('id_transaksi'); // Primary key
            $table->unsignedBigInteger('id_user'); // FK manual biar bisa refer ke id_user
            $table->date('tanggal_transaksi'); // Tanggal transaksi
            $table->string('metode_pembayaran', 50); // Tunai / Transfer / dll
            $table->decimal('total_harga', 12, 2); // Total harga
            $table->timestamps();

            //  Relasi ke tabel users
            $table->foreign('id_user')
                  ->references('id_user') //  harus sama kayak kolom di tabel users
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi_penjualan');
    }
};
