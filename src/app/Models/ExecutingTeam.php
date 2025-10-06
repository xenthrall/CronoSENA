<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExecutingTeam extends Model
{
    protected $table = 'executing_teams';

    protected $fillable = [
        'name',
        'description',
    ];

    public function instructors()
    {
        return $this->hasMany(Instructor::class, 'executing_team_id');
    }
}
