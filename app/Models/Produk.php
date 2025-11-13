<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $primaryKey = 'id_produk'; // 💡 kasih tahu primary key-nya
    public $incrementing = false; // karena bukan auto increment
    protected $keyType = 'string'; // tipe data kode_produk biasanya string

    protected $guarded = [
    ];

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
