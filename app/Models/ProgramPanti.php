<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramPanti extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jenis_program() {
        return $this->belongsTo(JenisProgram::class);
    }

    public function foto_programs() {
        return $this->hasMany(FotoProgram::class);
    }
}
