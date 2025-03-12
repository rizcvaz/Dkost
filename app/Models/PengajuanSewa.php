<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSewa extends Model
{
    use HasFactory;
    // Tetapkan nama tabel secara eksplisit
    protected $table = 'pengajuan_sewa';

    protected $fillable = [
        'user_id',
        'kamar_id',
        'nik',
        'nama_lengkap',
        'alamat',
        'no_hp',
        'email',
        'tanggal_mulai',
        'tanggal_akhir',
        'status',
        'catatan',
    ];
    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke kamar
    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}

