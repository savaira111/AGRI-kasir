<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    protected $table = 'transaksi_penjualan';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_user',
        'tanggal_transaksi',
        'total_harga',
        'status',
        'metode_pembayaran',
    ];

    // relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // relasi ke detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    // relasi ke pembayaran
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_transaksi');
    }

    // relasi ke laporan penjualan
    public function laporan()
    {
        return $this->hasOne(LaporanPenjualan::class, 'id_transaksi');
    }

    // relasi ke cetak struk (opsional)
    public function struk()
    {
        return $this->hasOne(CetakStruk::class, 'id_transaksi');
    }
}
