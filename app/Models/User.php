<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'user'; // karena tabel kamu namanya 'user', bukan 'users'
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_user',
        'username',
        'email',
        'password',
        'role',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relasi ke tabel transaksi_penjualan
    public function transaksi()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'id_user');
    }
}
