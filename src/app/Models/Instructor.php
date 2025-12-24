<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class Instructor extends Authenticatable implements FilamentUser,  HasAvatar, HasName
{
    use Notifiable;

    protected $fillable = [
        'document_number',
        'document_type',
        'full_name',
        'name',
        'last_name',
        'email',
        'institutional_email',
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

    public function canAccessPanel(Panel $panel): bool
    {
        // Solo permitir si el panel es “instructor”
        return $panel->getId() === 'instructor' && $this->is_active;
    }
    public function getFilamentName(): string
    {

        if ($this->name && $this->last_name) {
            return "{$this->name} {$this->last_name}";
        }
        if ($this->name) {
            return $this->name;
        }
        return $this->full_name;
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if (! $this->photo_url) {
            return null;
        }
        $disk = Storage::disk('public');


        if (! $disk->exists($this->photo_url)) {
            return null;
        }
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        return $disk->url($this->photo_url);
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

    public function norms()
    {
        return $this->belongsToMany(Norm::class, 'instructor_norm')
            ->withPivot([]);
    }

    public function fichaCompetencyExecutions()
    {
        return $this->hasMany(FichaCompetencyExecution::class);
    }

    public function fichaInstructorLeaderships()
    {
        return $this->hasMany(FichaInstructorLeadership::class);
    }
}
