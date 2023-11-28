<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusPanti extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'alamat', 'tempat_lahir', 'tanggal_lahir', 'no_telepon', 'isActive'
    ];
}
