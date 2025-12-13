<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'municipalities';

    protected $fillable = [
        'name',
    ];

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function fichas()
    {
        return $this->hasMany(Ficha::class);
    }

}
