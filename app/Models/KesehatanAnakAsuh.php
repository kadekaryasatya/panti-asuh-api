<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KesehatanAnakAsuh extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function anakAsuhs(){
        return $this->belongsTo(AnakAsuh::class, 'anak_id');
    }
}
