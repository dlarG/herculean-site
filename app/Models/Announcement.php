<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    protected $fillable = [
        'coach_id', 'category_id', 'title', 'body', 'image_path', 'type', 'event_at', 'location',
    ];

    protected $casts = ['event_at' => 'datetime'];

    public function coach(): BelongsTo
    {
        return $this->belongsTo(Coach::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}