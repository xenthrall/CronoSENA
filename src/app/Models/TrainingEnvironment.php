<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingEnvironment extends Model
{
    protected $fillable = [
        'code',
        'name',
        'capacity',
        'location_id',
    ];

    /**
     * Location (campus / center) where this environment is located.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Executions (real scheduled usage of this environment).
     */
    public function competencyExecutions(): HasMany
    {
        return $this->hasMany(FichaCompetencyExecution::class);
    }
}
