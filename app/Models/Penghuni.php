<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    protected $fillable = [
        'kamar_id', 'nik', 'nama_lengkap', 'alamat', 'no_hp', 'email', 'status'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}



