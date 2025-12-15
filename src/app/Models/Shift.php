<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'name',
        'description',
        'color',
        'start_time',
        'end_time',
        'is_mixed',
        'segments',
        'valid_days',
        'is_active',
    ];

    protected $casts = [
        'is_mixed' => 'boolean',
        'is_active' => 'boolean',
        'segments' => 'array',
        'valid_days' => 'array',
        'start_time' => 'string',
        'end_time' => 'string',
    ];

    public function fichas()
    {
        return $this->hasMany(Ficha::class);
    }
}
