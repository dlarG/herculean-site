<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'group', 'gender_division', 'min_members', 'max_members', 'is_open',
    ];

    protected $casts = [
        'is_open' => 'boolean',
    ];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function getIsTeamAttribute(): bool
    {
        return $this->max_members > 1;
    }
}
