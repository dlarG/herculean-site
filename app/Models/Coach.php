<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coach extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'name',
        'password',
        'must_change_password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'must_change_password' => 'boolean',
        'password'             => 'hashed', // Laravel 10+ auto-hashes on set
    ];

    /**
     * Categories (events) this coach is assigned to.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'coach_category')
            ->withTimestamps();
    }

    /**
     * Announcements posted by this coach.
     */
    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class)->latest();
    }
}