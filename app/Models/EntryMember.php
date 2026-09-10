<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'entry_id', 'full_name', 'student_number', 'gender', 'program', 'year_level', 'contact_number', 'email',
    ];

    public function entry()
    {
        return $this->belongsTo(Entry::class);
    }
}
