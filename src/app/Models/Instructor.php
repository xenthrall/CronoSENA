<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Instructor extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'document_number',
        'document_type',
        'full_name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'executing_team_id',
        'profession_id',
        'specialty',
        'photo_url',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

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
}
