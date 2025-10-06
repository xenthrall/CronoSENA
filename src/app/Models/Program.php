<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'program_code',
        'name',
        'total_duration_hours',
        'version',
        'training_level_id',
        'special_program_name_id',
    ];

    public function trainingLevel()
    {
        return $this->belongsTo(TrainingLevel::class);
    }

    public function specialProgramName()
    {
        return $this->belongsTo(SpecialProgramName::class);
    }

    public function competencies()
    {
        return $this->belongsToMany(Competency::class, 'program_competency')
            ->withPivot([]);
    }
}
