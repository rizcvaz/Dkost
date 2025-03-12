<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\PengajuanSewa;
use App\Models\Kamar;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pengajuanSewa()
{
    return $this->hasOne(PengajuanSewa::class);
}

public function kamar()
{
    return $this->hasOneThrough(
        Kamar::class,              // Model tujuan (Kamar)
        PengajuanSewa::class,      // Model perantara (PengajuanSewa)
        'user_id',                 // FK di PengajuanSewa menuju User
        'id',                      // FK di Kamar menuju PengajuanSewa
        'id',                      // PK di User
        'kamar_id'                 // FK di PengajuanSewa menuju Kamar
    );
}
}
