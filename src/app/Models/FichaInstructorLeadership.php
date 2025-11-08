<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaInstructorLeadership extends Model
{
    protected $table = 'ficha_instructor_leaderships';

    protected $fillable = [
        'ficha_id',
        'instructor_id',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
