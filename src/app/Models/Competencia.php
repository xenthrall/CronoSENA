<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Competencia extends Model
{
    protected $table = 'competencias';

    protected $fillable = [
        'tipo_competencia_id',
        'codigo_norma',
        'nombre',
        'descripcion_norma',
        'duracion_horas',
        'version',
    ];

    public function getRecordTitleAttribute(): string
    {
        return "{$this->codigo_norma} - {$this->nombre}";
    }

    /**
     * Relación: una competencia pertenece a un tipo de competencia.
     */
    public function tipoCompetencia()
    {
        return $this->belongsTo(TipoCompetencia::class, 'tipo_competencia_id');
    }

    /**
     * Relación: una competencia puede ser asignada en programas.
     */

    public function programas(): BelongsToMany
    {
        return $this->belongsToMany(Programa::class, 'programa_competencia', 'competencia_id', 'programa_id');
    }
    /**
     * Relación: una competencia puede ser asignada en instructores.
     */
    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(Instructor::class, 'instructor_competencia', 'competencia_id', 'instructor_id');
    }
}
