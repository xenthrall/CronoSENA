<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoCompetencia extends Model
{
    //
    protected $table = 'tipos_competencia';
    protected $fillable = [
        'nombre',
        'descripcion',
    ];
}
