<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    // Guard field
    protected $guarded = ['department_id', 'department_uuid'];

    // Relationship
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
    }
}