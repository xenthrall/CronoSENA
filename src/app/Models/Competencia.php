<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    /**
     * Relación: una competencia pertenece a un tipo de competencia.
     */
    public function tipoCompetencia()
    {
        return $this->belongsTo(TipoCompetencia::class, 'tipo_competencia_id');
    }
}
