<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Instructor extends Model
{
    protected $table = 'instructores';
    protected $fillable = [
        'documento',
        'tipo_documento',
        'nombre',
        'apellido',
        'correo',
        'telefono',
        'equipo_ejecutor_id',
        'profesion_id',
        'especialidad',
        'foto_url',
        'activo',
    ];

    /**
     * Relaciones
     */

    // Un instructor pertenece a un equipo ejecutor
    public function equipoEjecutor()
    {
        return $this->belongsTo(EquipoEjecutor::class, 'equipo_ejecutor_id');
    }

    /*/ Un instructor pertenece a una profesión
    public function profesion()
    {
        return $this->belongsTo(Profesion::class, 'profesion_id');
    }
    */

    protected $casts = [
        'activo' => 'boolean',
    ];

}
