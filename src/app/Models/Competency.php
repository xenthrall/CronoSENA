<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    protected $table = 'competencies';

    protected $fillable = [
        'competency_type_id',
        'code',
        'name',
        'description',
        'duration_hours',
        'version',
    ];

    public function competencyType()
    {
        return $this->belongsTo(CompetencyType::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_competency')
            ->withPivot([]);
    }

    public function instructors()
    {
        return $this->belongsToMany(Instructor::class, 'instructor_competency')
            ->withPivot([]);
    }

    public function fichas()
    {
        return $this->belongsToMany(Ficha::class, 'ficha_competencies')
            ->using(FichaCompetency::class)
            ->withPivot([
                'order',
                'total_hours_competency',
                'executed_hours',
                'status',
                'notes',
            ])
            ->withTimestamps();
    }

    public function fichaCompetencies()
    {
        return $this->hasMany(FichaCompetency::class);
    }
}
