<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
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

    // scope
    public function scopeSearch(Builder $query, ?string $term): void
    {
        if ($term) {
            $query->where(function (Builder $q) use ($term) {
                $q->where('project_title', 'like', '%' . $term . '%')
                    ->orWhere('project_description', 'like', '%' . $term . '%')
                    ->orWhere('project_technology', 'like', '%' . $term . '%')
                    ->orWhereHas('user', function (Builder $userQuery) use ($term) {
                        $userQuery->where('user_name', 'like', '%' . $term . '%');
                    })
                    ->orWhereHas('user', function (Builder $userQuery) use ($term) {
                        $userQuery->where('user_badge', 'like', '%' . $term . '%');
                    });
            });
        }
    }

    public function scopeFilterByDepartment(Builder $query, ?int $deptId): void
    {
        if ($deptId) {
            $query->whereHas('user', function ($userQuery) use ($deptId) {
                $userQuery->where('department_id', $deptId);
            });
        }
    }

    public function scopeFilterByCategory(Builder $query, ?int $categoryId): void
    {
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
    }
}
