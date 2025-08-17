<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/SuratMasuk.php
class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = 'surat_masuk';

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'kepada', 'id');
    }

    public function disposisi()
    {
        return $this->hasMany(Disposisi::class, 'id_surat');
    }
}

