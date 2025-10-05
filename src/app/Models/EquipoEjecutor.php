<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipoEjecutor extends Model
{
    protected $table = 'equipo_ejecutor';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function instructores()
    {
        return $this->hasMany(Instructor::class, 'equipo_ejecutor_id');
    }
}
