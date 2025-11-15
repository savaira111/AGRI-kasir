<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CetakStruk extends Model
{
    use HasFactory;

    protected $table = 'cetak_struk';
    protected $primaryKey = 'id_struk';

    protected $fillable = [
        'id_transaksi',
        'file_path'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaction::class, 'id_transaksi');
    }
}
