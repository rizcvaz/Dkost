<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghuni extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'no_hp',
        'email',
        'kamar_id',
        'status',
    ];

    // Relasi ke model Kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
