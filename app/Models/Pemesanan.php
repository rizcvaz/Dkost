<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';

    protected $fillable = [
        'kamar_id',
        'user_id',
        'nik',
        'nama_lengkap',
        'alamat',
        'no_hp',
        'email',
        'status',
        'order_id',
        'jumlah_tagihan',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}

