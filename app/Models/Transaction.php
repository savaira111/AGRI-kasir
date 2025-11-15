<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaksi_penjualan';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_user',
        'tanggal_transaksi',
        'total_harga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id', 'id_transaksi');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'transaksi_id', 'id_transaksi');
    }

    public function struk()
    {
        return $this->hasOne(Struk::class, 'transaksi_id', 'id_transaksi');
    }
}
