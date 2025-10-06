<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaStatus extends Model
{
    protected $fillable = [
        'name',
        'code',
        'color',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
