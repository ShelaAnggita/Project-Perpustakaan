<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLE_ANGGOTA = 'anggota';
    public const ROLE_PETUGAS = 'petugas';
    public const ROLE_KEPALA = 'kepala_perpustakaan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'nama_lengkap',
    'email',
    'password',
    'role',
];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function peminjaman(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function isAnggota(): bool
    {
        return $this->role === self::ROLE_ANGGOTA;
    }

    public function isPetugas(): bool
    {
        return $this->role === self::ROLE_PETUGAS;
    }

    public function isKepala(): bool
    {
        return $this->role === self::ROLE_KEPALA;
    }
}
