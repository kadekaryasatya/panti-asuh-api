<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProgram extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function program_panti() {
        return $this->belongsTo(ProgramPanti::class);
    }
}
