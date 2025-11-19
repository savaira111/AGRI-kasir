<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Nama tabel custom
    protected $table = 'transaksi'; 

    // Primary key
    protected $primaryKey = 'id'; 

    // Boleh mass assignment
    protected $fillable = [
        'id_user',
        'tanggal_transaksi',
        'total_harga',
        'metode_pembayaran',
        'bayar',
        'kembalian',
    ];

    // --- RELASI ---

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi ke detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id');
    }

    // Relasi ke pembayaran (kalau ada tabel pembayaran)
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'transaksi_id', 'id');
    }

    // Relasi ke struk (kalau ada tabel struk)
    public function struk()
    {
        return $this->hasOne(Struk::class, 'transaksi_id', 'id');
    }
}
