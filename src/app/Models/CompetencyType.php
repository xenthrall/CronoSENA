<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetencyType extends Model
{
    protected $table = 'competency_types';

    protected $fillable = [
        'name',
        'description',
    ];

}
