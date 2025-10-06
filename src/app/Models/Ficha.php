<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    protected $fillable = [
        'code',
        'start_date',
        'lective_end_date',
        'end_date',
        'program_id',
        'municipality_id',
        'status_id',
        'shift_id',
    ];

    /**
     * Una ficha pertenece a un programa
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function status()
    {
        return $this->belongsTo(FichaStatus::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function competencies()
    {
        return $this->belongsToMany(Competency::class, 'ficha_competencies')
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
