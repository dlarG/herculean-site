<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Coach extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['username', 'name', 'password', 'must_change_password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['must_change_password' => 'boolean', 'password' => 'hashed'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'coach_category')->withTimestamps();
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class);
    }
}