<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pembayaran';

    // Primary key tabel
    protected $primaryKey = 'id_pembayaran';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'id_transaksi',
        'metode_pembayaran',
        'jumlah_bayar',
        'kembalian',
        'tanggal_pembayaran',
    ];

    // Relasi ke tabel TransaksiPenjualan (setiap pembayaran punya 1 transaksi)
    public function transaksi()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'id_transaksi');
    }
}
