<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'laporan_penjualan';

    // Primary key tabel
    protected $primaryKey = 'id_laporan';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'id_transaksi',
        'id_pembayaran',
        'tanggal_laporan',
        'total_penjualan',
    ];

    // Relasi ke tabel Transaksi
    // Setiap laporan berhubungan dengan satu transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    // Relasi ke tabel Pembayaran
    // Setiap laporan juga bisa punya satu data pembayaran
    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_pembayaran');
    }
}
