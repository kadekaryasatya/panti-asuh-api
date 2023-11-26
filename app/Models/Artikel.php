<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    Protected $guarded = ['id'];

    Public function pengurus_panti(){
        return $this-> hasMany(PengurusPanti::class);
    }
}
