<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Disposisi.php
class Disposisi extends Model
{
    use HasFactory;

    protected $table = 'disposisi';

    public function surat()
    {
        return $this->belongsTo(SuratMasuk::class, 'id_surat');
    }

    public function kepada()
    {
        return $this->belongsTo(User::class, 'kepada');
    }

    public function oleh()
    {
        return $this->belongsTo(User::class, 'oleh');
    }
}

