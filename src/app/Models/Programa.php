<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Programa extends Model
{
    protected $table = 'programas';

    protected $fillable = [
        'codigo_programa',
        'nombre',
        'duracion_total_horas',
        'nivel_formacion_id',
        'nombre_programa_especial_id',
    ];

    
    public function nivelFormacion()
    {
        return $this->belongsTo(NivelFormacion::class, 'nivel_formacion_id');
    }

    public function nombreProgramaEspecial()
    {
        return $this->belongsTo(NombreProgramaEspecial::class, 'nombre_programa_especial_id');
    }


    /**
     * Las competencias que pertenecen al programa.
     */
    public function competencias():BelongsToMany
    {
        return $this->belongsToMany(Competencia::class, 'programa_competencia', 'programa_id', 'competencia_id');
    }
}
