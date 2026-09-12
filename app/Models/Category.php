<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'group',
        'gender_division',
        'min_members',
        'max_members',
        'is_open',
        'description',
        'parent_id',
        'has_variants',
        'sort_order',
    ];

    protected $casts = [
        'is_open'      => 'boolean',
        'has_variants' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order')->orderBy('name');
    }

    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeVariants($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function getIsTeamAttribute(): bool
    {
        return $this->max_members > 1;
    }
    public function coaches(): BelongsToMany
    {
        return $this->belongsToMany(Coach::class, 'coach_category')
            ->withTimestamps();
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }
}
