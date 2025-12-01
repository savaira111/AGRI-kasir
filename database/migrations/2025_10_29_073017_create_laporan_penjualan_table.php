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
            $table->string('periode'); 
            $table->decimal('total_penjualan', 10, 2); 
            $table->integer('total_transaksi'); 
            $table->unsignedBigInteger('dibuat_oleh')->nullable(); 
            $table->timestamps();

            
            $table->foreign('dibuat_oleh')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporan_penjualan');
    }
};
