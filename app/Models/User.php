<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // ============================
    // RELASI: USER → TRANSAKSI
    // ============================
    public function transaksi()
    {
        return $this->hasMany(TransaksiPenjualan::class, 'id_user');
    }

    // ============================
    // RELASI: USER → LAPORAN
    // ============================
    public function laporan()
    {
        return $this->hasMany(LaporanPenjualan::class, 'dibuat_oleh');
    }
}
