<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpecialProgramName extends Model
{
    protected $table = 'special_program_names';

    protected $fillable = [
        'name',
    ];
}
