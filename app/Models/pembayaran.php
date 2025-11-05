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

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'id_transaksi',
        'metode_pembayaran',
        'nominal_bayar',
        'kembalian',
        'status_pembayaran',
        'tanggal_pembayaran',
    ];

    // Relasi ke tabel TransaksiPenjualan (setiap pembayaran punya 1 transaksi)
    public function transaksi()
    {
        return $this->belongsTo(TransaksiPenjualan::class, 'id_transaksi');
    }

    // Fungsi buat proses pembayaran (contoh sederhana)
    public function prosesPembayaran()
    {
        // Misal: ubah status pembayaran jadi 'Lunas'
        $this->status_pembayaran = 'Lunas';
        $this->save();
    }

    // Fungsi buat hitung kembalian
    public function hitungKembalian()
    {
        return $this->nominal_bayar - $this->transaksi->total_transaksi;
    }
}
