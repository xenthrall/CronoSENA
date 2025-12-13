<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'name',
        'address',
        'description',
        'municipality_id',
    ];

    /**
     * Municipality to which the location belongs.
     */
    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    /**
     * Training environments within this location.
     * (Optional but strongly recommended for your domain)
     */
    public function trainingEnvironments(): HasMany
    {
        return $this->hasMany(TrainingEnvironment::class);
    }
}
