<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Instructor extends Model
{
    protected $fillable = [
        'document_number',
        'document_type',
        'full_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'executing_team_id',
        'profession_id',
        'specialty',
        'photo_url',
        'is_active',
    ];

    /**
     * Relaciones
     */

    // Un instructor pertenece a un equipo ejecutor
    public function executingTeam()
{
    return $this->belongsTo(ExecutingTeam::class, 'executing_team_id');
}

    /*/ Un instructor pertenece a una profesión
    public function profesion()
    {
        return $this->belongsTo(Profesion::class, 'profesion_id');
    }
    */
    //Un instructor tiene muchas competencias
    public function competencies(): BelongsToMany
    {
        return $this->belongsToMany(Competency::class, 'instructor_competencia', 'instructor_id', 'competencia_id');
    }

    protected $casts = [
        'is_active' => 'boolean',
    ];

}
