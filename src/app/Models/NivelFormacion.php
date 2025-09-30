<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NivelFormacion extends Model
{
    protected $table = 'niveles_formacion';

    protected $fillable = [
        'nombre',
        
    ];

    public function programas()
    {
        return $this->hasMany(Programa::class, 'nivel_formacion_id');
    }
}
