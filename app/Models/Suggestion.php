<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suggestion extends Model
{
    // Set primary key
    protected $primaryKey = 'suggestion_id';

    // Guard field
    protected $guarded = ['suggestion_id', 'suggestion_uuid'];

    // Hidden field
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getRouteKeyName()
    {
        return 'suggestion_uuid';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($suggestion) {
            $suggestion->suggestion_uuid = (string) Str::uuid();
        });
    }

    // Relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
