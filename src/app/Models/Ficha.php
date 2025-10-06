<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    //
    protected $table = 'fichas';

    protected $fillable = [
        'codigo',
        'fecha_inicio',
        'fecha_fin_lectiva',
        'fecha_fin',
        'programa_id',
        'municipio_id',
        'estado_id',
        'jornada_id',
    ];

    /**
     * Una ficha pertenece a un programa
     */
    public function programa()
    {
        return $this->belongsTo(Program::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoFicha::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function jornada()
    {
        return $this->belongsTo(Jornada::class);
    }
}
