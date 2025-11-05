<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    /** @use HasFactory<\Database\Factories\ProdukFactory> */
    use HasFactory;

    /**
     * Nama tabel yang digunakan model ini.
     *
     * @var string
     */
    protected $table = 'produk';

    /**
     * Atribut yang bisa diisi (mass assignable).
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'kategori_id',
    ];

    /**
     * Atribut yang disembunyikan.
     *
     * @var list<string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Atribut yang dikonversi (cast).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'harga' => 'integer',
            'stok' => 'integer',
        ];
    }
}
