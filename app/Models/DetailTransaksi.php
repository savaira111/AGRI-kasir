<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    // nama tabel di database
    protected $table = 'detail_transaksi';

    // kolom yang bisa diisi
    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'jumlah',
        'subtotal',
    ];

    // relasi ke tabel transaksi
    public function transaksi()
    {
        // satu detail transaksi itu punya satu transaksi utama
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    // relasi ke tabel produk
    public function produk()
    {
        // satu detail transaksi itu ngarah ke satu produk
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
