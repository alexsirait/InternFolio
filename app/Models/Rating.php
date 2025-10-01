<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    // Guard field
    protected $guarded = ['rating_id', 'rating_uuid'];

    // Hidden field
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($rating) {
            $rating->rating_uuid = (string) Str::uuid();
        });
    }

    // Relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
