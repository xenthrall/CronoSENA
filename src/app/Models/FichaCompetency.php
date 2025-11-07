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

    protected $appends = ['remaining_hours', 'progress_percentage'];

    public function getRemainingHoursAttribute()
    {
        $total = $this->total_hours_competency ?? 0;
        $executed = $this->executed_hours ?? 0;

        return max($total - $executed, 0);
    }

    public function getProgressPercentageAttribute()
    {
        $total = $this->total_hours_competency ?? 0;
        $executed = $this->executed_hours ?? 0;

        if ($total === 0) {
            return 0;
        }

        $percentage = round(($executed / $total) * 100, 0);
        return $this->status . ' (' . $percentage . '%)';
    }


    public function ficha()
    {
        return $this->belongsTo(Ficha::class);
    }

    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }

    public function executions()
    {
        return $this->hasMany(FichaCompetencyExecution::class);
    }
}
