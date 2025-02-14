<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; 

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'age', 'email'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}

