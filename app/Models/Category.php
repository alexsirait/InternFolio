<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    // Set primary key
    protected $primaryKey = 'category_id';

    // Guard field
    protected $guarded = ['category_id', 'category_uuid'];

    // Hidden field
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->category_uuid = (string) Str::uuid();
        });
    }

    // Relationship
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
    }
}
