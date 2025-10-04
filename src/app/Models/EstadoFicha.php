<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoFicha extends Model
{
    //
    protected $table = 'estados_ficha';

    protected $fillable = ['nombre', 'codigo', 'color', 'orden', 'activo'];


    public function fichas()
    {
        return $this->hasMany(Ficha::class);
    }
}
