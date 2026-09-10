<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'team_name'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function members()
    {
        return $this->hasMany(EntryMember::class);
    }
}
