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
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
    
    protected $appends = ['is_active'];

    public function getIsActiveAttribute()
    {
        return is_null($this->end_date);
    }

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }
}
