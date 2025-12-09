<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Norm extends Model
{
    protected $table = 'norms';

    protected $fillable = [
        'code',
        'name',
        'description',
        'version',
    ];

    /**
     * -----------------------------------------
     * Relationships
     * -----------------------------------------
     */

    // Una norma laboral puede estar asociada a muchas competencias de diferentes programas
    public function competencies()
    {
        return $this->hasMany(Competency::class, 'norm_id');
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_norm')
            ->withPivot([]);
    }
}
