<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FichaCompetencyExecution extends Model
{
    protected $table = 'ficha_competency_executions';
    
    protected $fillable = [
        'ficha_competency_id',
        'instructor_id',
        'scheduled_hours',
    ];

    public function fichaCompetency()
    {
        return $this->belongsTo(FichaCompetency::class);
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class);
    }

}
