<?php

namespace App\Models\Instructor;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    //como base a municipios para probar
    protected $table = 'municipalities';

    protected $fillable = [
        'name',
    ];

}
