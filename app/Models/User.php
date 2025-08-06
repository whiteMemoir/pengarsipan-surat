<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'nama',
        'email',
        'password',
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

    // app/Models/User.php
    public function bagian()
    {
        return $this->belongsTo(Bagian::class, 'id_bagian');
    }

    public function suratMasukDibuat()
    {
        return $this->hasMany(SuratMasuk::class, 'dibuat_oleh');
    }

    public function suratMasukKepada()
    {
        return $this->hasMany(SuratMasuk::class, 'kepada');
    }

    public function suratKeluarDibuat()
    {
        return $this->hasMany(SuratKeluar::class, 'dibuat_oleh');
    }

    public function suratKeluarMengetahui()
    {
        return $this->hasMany(SuratKeluar::class, 'mengetahui');
    }

    public function disposisiKepada()
    {
        return $this->hasMany(Disposisi::class, 'kepada');
    }

    public function disposisiOleh()
    {
        return $this->hasMany(Disposisi::class, 'oleh');
    }
}
