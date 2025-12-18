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
        'clicks',
    ];

    protected $casts = [
        'clicks' => 'integer',
    ];

    /**
     * Get the parent linkable model (Intern, Project, or Suggestion).
     */
    public function linkable(): MorphTo
    {
        return $this->morphTo();
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

        // Create new shortlink
        return self::create([
            'code' => self::generateUniqueCode(),
            'original_url' => $url,
            'linkable_type' => get_class($model),
            'linkable_id' => $model->id ?? $model->user_uuid ?? $model->project_uuid ?? $model->suggestion_uuid,
        ]);
    }
}
