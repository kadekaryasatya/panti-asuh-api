<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisProgram extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function program_pantis() {
        return $this->hasMany(ProgramPanti::class);
    }
}
