<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk'; 
    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $guarded = [];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'harga_jual' => 'integer',
        'stok' => 'integer',
    ];

    // Relasi ke detail transaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_produk');
    }

    // ❌ Hapus relasi ke Pemasok & Kategori karena modelnya tidak ada
    // public function pemasok()
    // {
    //     return $this->belongsTo(Pemasok::class, 'id_pemasok');
    // }

    // public function kategori()
    // {
    //     return $this->belongsTo(Kategori::class, 'id_kategori');
    // }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produk) {
            if (!$produk->tanggal_input) {
                $produk->tanggal_input = now();
            }
        });
    }
}
