<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/SuratKeluar.php
class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'surat_keluar';

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function knowUser()
    {
        return $this->belongsTo(User::class, 'mengetahui');
    }
}

