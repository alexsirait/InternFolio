<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Photo extends Model
{
    // Set primary key
    protected $primaryKey = 'photo_id';

    // Guard field
    protected $guarded = ['photo_id', 'photo_uuid'];

    // Hidden field
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getRouteKeyName()
    {
        return 'photo_uuid';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($photo) {
            $photo->photo_uuid = (string) Str::uuid();
        });

        static::deleting(function ($photo) {
            if ($photo->photo_url && Storage::disk('public')->exists($photo->photo_url)) {
                Storage::disk('public')->delete($photo->photo_url);
            }
        });
    }

    // Relationship
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
