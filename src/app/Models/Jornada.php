<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    //
    protected $fillable = [
        'nombre',
        'descripcion',
        'hora_inicio',
        'hora_fin',
        'es_mixta',
        'segmentos',
        'dias_validos',
        'activo',
    ];

    protected $casts = [
        'es_mixta' => 'boolean',
        'segmentos' => 'array',   // convierte el JSON en array automáticamente
        'dias_validos' => 'array', // idem para los días
        'hora_inicio' => 'datetime:h:i A', // Formato de 12 horas con AM/PM
        'hora_fin' => 'datetime:h:i A', //Para formato militar usar H:i
    ];

    /**
     * Relación: una jornada puede estar asignada a muchas fichas
     */
    public function fichas()
    {
        return $this->hasMany(Ficha::class);
    }

}
