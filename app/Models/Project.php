<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    // Set primary key
    protected $primaryKey = 'project_id';

    // Guard field
    protected $guarded = ['project_id', 'project_uuid'];

    // Hidden field
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function getRouteKeyName()
    {
        return 'project_uuid';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            $project->project_uuid = (string) Str::uuid();
        });

        static::deleting(function ($project) {
            // Hapus semua file gambar terkait
            foreach ($project->photos as $photo) {
                if ($photo->photo_url && Storage::disk('public')->exists($photo->photo_url)) {
                    Storage::disk('public')->delete($photo->photo_url);
                }
            }

            // Hapus relasi photo di database
            $project->photos()->delete();
        });
    }

    // Relationship
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class, 'project_id')->orderByDesc('photo_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
