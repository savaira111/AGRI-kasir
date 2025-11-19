<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal_transaksi');
            $table->decimal('total_harga', 15, 2);
            $table->string('metode_pembayaran')->nullable();
            $table->decimal('bayar', 15, 2)->nullable();
            $table->decimal('kembalian', 15, 2)->nullable();
            $table->timestamps();
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
