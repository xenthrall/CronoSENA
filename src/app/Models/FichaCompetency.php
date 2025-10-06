<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaCompetency extends Model
{
    protected $table = 'ficha_competencies';

    protected $fillable = [
        'ficha_id',
        'competency_id',
        'order',
        'total_hours_competency',
        'executed_hours',
        'status',
        'notes',
    ];

    protected $casts = [
        'executed_hours' => 'integer',
        'total_hours_competency' => 'integer',
    ];

    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }
}
