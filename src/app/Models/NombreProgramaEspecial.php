<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NombreProgramaEspecial extends Model
{
    protected $table = 'nombre_programa_especial';

    protected $fillable = [
        'nombre',
    ];

    public function programas()
    {
        return $this->hasMany(Programa::class, 'nombre_programa_especial_id');
    }
}
