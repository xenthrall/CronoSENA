<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //
    protected $table = 'municipios';

    protected $fillable = ['nombre'];



    /**
     * Un municipio tiene muchas fichas
     */

    public function fichas()
    {
        return $this->hasMany(Ficha::class);
    }
}
