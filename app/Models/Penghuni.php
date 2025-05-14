<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $fillable = [
        'nik', 'nama_lengkap', 'alamat', 'no_hp', 'email', 'kamar_id'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}


