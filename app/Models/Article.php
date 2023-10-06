<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'text',
        'thumbnail',
    ];

    public function thumbnailUrl(): Attribute
    {
        return Attribute::make(get: fn() => Storage::url($this->thumbnail));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function polyComments(): MorphMany
    {
        return $this->morphMany(PolyComment::class, 'commentable');
    }

    public function latestPolyComments(): MorphOne
    {
        return $this->morphOne(PolyComment::class, 'commentable')->latestOfMany();
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)
            ->withTimestamps()
            ->withPivot(['is_published', 'priority']);
    }

    public function polyTags(): MorphToMany
    {
        return $this->morphToMany(PolyTag::class, 'taggable');
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    
    public function tag(): HasOne
    {
        return $this->hasOne(Tag::class);
    }
}
