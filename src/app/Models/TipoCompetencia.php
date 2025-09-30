<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCompetencia extends Model
{
    //
    protected $table = 'tipos_competencia';

    protected $fillable = [
        'nombre', 
        'descripcion'
    ];

    /**
     * Relación: un tipo de competencia tiene muchas competencias.
     */
    public function competencias()
    {
        return $this->hasMany(Competencia::class, 'tipo_competencia_id');
    }
}
