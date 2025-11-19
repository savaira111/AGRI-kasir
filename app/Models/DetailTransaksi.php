<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_transaksi',
        'id_produk',
        'jumlah',
        'subtotal',
    ];

    // Relasi ke transaksi utama
    public function transaksi()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi', 'id');
    }

    // Relasi ke produk (DIPERBAIKI)
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }
}
