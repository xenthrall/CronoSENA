<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    protected $table = 'competencies';

    protected $fillable = [
        'program_id',
        'norm_id',
        'competency_type_id',
        'name',
        'description',
        'duration_hours',
    ];

    /**
     * -----------------------------------------
     * BelongsTo Relationships
     * -----------------------------------------
     */

    // La competencia pertenece a un programa
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    // La competencia puede estar asociada a una norma laboral
    public function norm()
    {
        return $this->belongsTo(Norm::class);
    }

    // Tipo de competencia (opcional)
    public function competencyType()
    {
        return $this->belongsTo(CompetencyType::class);
    }


    /**
     * -----------------------------------------
     * BelongsToMany / HasMany Relationships
     * -----------------------------------------
     */

    // Relación con fichas (competencias asignadas a fichas)
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

    // Historial de asociaciones con fichas
    public function fichaCompetencies()
    {
        return $this->hasMany(FichaCompetency::class);
    }
}
