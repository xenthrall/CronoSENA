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

    /**
     * -----------------------------------------
     * BelongsTo Relationships
     * -----------------------------------------
     */

    public function trainingLevel()
    {
        return $this->belongsTo(TrainingLevel::class);
    }

    public function specialProgramName()
    {
        return $this->belongsTo(SpecialProgramName::class);
    }

    /**
     * -----------------------------------------
     * HasMany Relationships
     * -----------------------------------------
     */

    // Un programa tiene muchas competencias
    public function competencies()
    {
        return $this->hasMany(Competency::class, 'program_id');
    }
}
