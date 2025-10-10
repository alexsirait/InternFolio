<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, SoftDeletes;

    // Set primary key
    protected $primaryKey = 'user_id';

    // Guard field
    protected $guarded = ['user_id', 'user_uuid'];

    // Hidden field
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'is_admin',
        'created_at',
        'updated_at'
    ];

    // Casting
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getNameAttribute(): string
    {
        return $this->user_name;
    }

    public function getRouteKeyName()
    {
        return 'user_uuid';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->user_uuid = (string) Str::uuid();
        });
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $panel_id = $panel->getId();
        if ($panel_id === 'admin') {
            return $this->is_admin == 1;
        } else {
            return false;
        }
    }

    // Relationship
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    public function suggestions(): HasMany
    {
        return $this->hasMany(Suggestion::class);
    }

    public function rating(): HasOne
    {
        return $this->hasOne(Rating::class);
    }
}
