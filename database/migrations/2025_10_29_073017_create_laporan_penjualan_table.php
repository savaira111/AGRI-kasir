<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporan_penjualan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->string('periode'); // contoh: "Oktober 2025"
            $table->decimal('total_penjualan', 10, 2); // total uang masuk selama periode
            $table->integer('total_transaksi'); // jumlah transaksi selama periode
            $table->unsignedBigInteger('dibuat_oleh')->nullable(); // id user (admin/kasir)
            $table->timestamps();

            // relasi ke tabel user
            $table->foreign('dibuat_oleh')
                  ->references('id_user')
                  ->on('user')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_penjualan');
    }
};
