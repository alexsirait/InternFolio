<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Suggestion extends Model
{
    // Set primary key
    protected $primaryKey = 'suggestion_id';

    // Guard field
    protected $guarded = ['suggestion_id', 'suggestion_uuid'];

    // Hidden field
    protected $hidden = [
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
        return $this->belongsTo(User::class, 'user_id');
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
                $q->where('suggestion_title', 'like', '%' . $term . '%')
                    ->orWhere('suggestion_description', 'like', '%' . $term . '%')
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
}
