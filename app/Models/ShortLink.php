<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class ShortLink extends Model
{
    protected $fillable = [
        'code',
        'original_url',
        'linkable_type',
        'linkable_id',
        'user_id',
        'clicks',
    ];

    protected $casts = [
        'clicks' => 'integer',
    ];

    /**
     * Get the parent linkable model (Intern, Project, or Suggestion).
     * Note: linkable_id stores UUIDs (user_uuid, project_uuid, suggestion_uuid)
     */
    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }
    
    /**
     * Load linkable relationship with proper UUID matching
     */
    public function loadLinkableByUuid()
    {
        $type = $this->linkable_type;
        $id = $this->linkable_id;
        
        if (!$type || !$id) {
            return null;
        }
        
        // Load the correct model by UUID
        $model = null;
        if ($type === 'App\Models\User') {
            $model = User::where('user_uuid', $id)->first();
        } elseif ($type === 'App\Models\Project') {
            $model = Project::where('project_uuid', $id)->first();
        } elseif ($type === 'App\Models\Suggestion') {
            $model = Suggestion::where('suggestion_uuid', $id)->first();
        }
        
        return $model;
    }

    /**
     * Get the user who owns the content.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Generate a unique shortlink code.
     */
    public static function generateUniqueCode(): string
    {
        do {
            $code = Str::random(6);
        } while (self::where('code', $code)->exists());

        return $code;
    }

    /**
     * Get the full shortlink URL.
     */
    public function getShortUrlAttribute(): string
    {
        return url('/s/' . $this->code);
    }

    /**
     * Increment the click counter.
     */
    public function incrementClicks(): void
    {
        $this->increment('clicks');
    }

    /**
     * Create or get existing shortlink for a model.
     */
    public static function createForModel($model, string $url): self
    {
        // Check if shortlink already exists for this model
        $shortLink = self::where('linkable_type', get_class($model))
            ->where('linkable_id', $model->id ?? $model->user_uuid ?? $model->project_uuid ?? $model->suggestion_uuid)
            ->first();

        if ($shortLink) {
            return $shortLink;
        }

        // Extract user_id based on model type
        $userId = null;
        if ($model instanceof User) {
            $userId = $model->user_id;
        } elseif (method_exists($model, 'user') && $model->user) {
            $userId = $model->user->user_id;
        }

        // Create new shortlink
        return self::create([
            'code' => self::generateUniqueCode(),
            'original_url' => $url,
            'linkable_type' => get_class($model),
            'linkable_id' => $model->id ?? $model->user_uuid ?? $model->project_uuid ?? $model->suggestion_uuid,
            'user_id' => $userId,
        ]);
    }
}
