<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaksi'; 
    protected $primaryKey = 'id'; 

    protected $guarded = [];

    // Relasi ke user (benarnya singular)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // Relasi ke detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

    // Relasi ke pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'transaksi_id');
    }

    // Relasi ke struk
    public function struk()
    {
        return $this->hasOne(Struk::class, 'transaksi_id');
    }
}
