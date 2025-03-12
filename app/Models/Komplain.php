<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komplain extends Model
{
    use HasFactory;

    protected $table = 'komplain'; // Perhatikan nama tabel di sini!

    protected $fillable = [
        'user_id',
        'kategori',
        'deskripsi',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // user_id sebagai foreign key
    }
}
