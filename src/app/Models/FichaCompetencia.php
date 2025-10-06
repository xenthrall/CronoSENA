<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaCompetencia extends Model
{
    protected $table = 'ficha_competencia';

    protected $fillable = [
        'ficha_id',
        'competencia_id',
        'orden',
        'horas_totales_competencia',
        'horas_ejecutadas',
        'estado',
        'observaciones',
    ];

    /* -------------------------
     | RELACIONES
     --------------------------*/

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }

    public function competencia()
    {
        return $this->belongsTo(Competency::class);
    }

    /*
    public function ejecuciones()
    {
        return $this->hasMany(FichaCompetenciaEjecucion::class, 'ficha_competencia_id');
    }*/

    /* -------------------------
     | MÉTODOS ÚTILES
     --------------------------*/

    // Calcular porcentaje de avance
    public function getPorcentajeAvanceAttribute()
    {
        if ($this->horas_totales_competencia == 0) return 0;

        return round(($this->horas_ejecutadas / $this->horas_totales_competencia) * 100, 2);
    }

}
