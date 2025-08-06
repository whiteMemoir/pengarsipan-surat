<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Bagian.php
class Bagian extends Model
{
    use HasFactory;

    protected $table = 'bagian';

    public function users()
    {
        return $this->hasMany(User::class, 'id_bagian');
    }
}

