<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Instructor extends Model
{
    protected $table = 'instructores';
    protected $fillable = [
        'documento',
        'tipo_documento',
        'nombre_completo',
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
    //Un instructor tiene muchas competencias
    public function competencias(): BelongsToMany
    {
        return $this->belongsToMany(Competencia::class, 'instructor_competencia', 'instructor_id', 'competencia_id');
    }

    protected $casts = [
        'activo' => 'boolean',
    ];

}
