<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/SuratMasuk.php
class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    public function dibuatOleh()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function kepada()
    {
        return $this->belongsTo(User::class, 'kepada');
    }

    public function disposisi()
    {
        return $this->hasMany(Disposisi::class, 'id_surat');
    }
}

