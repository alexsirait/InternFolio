<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    // Set primary key
    protected $primaryKey = 'department_id';

    // Guard field
    protected $guarded = ['department_id', 'department_uuid'];

    public function getRouteKeyName()
    {
        return 'department_uuid';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($department) {
            $department->department_uuid = (string) Str::uuid();
        });
    }

    // Relationship
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
