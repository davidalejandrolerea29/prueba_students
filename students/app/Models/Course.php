<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Carbon\Carbon; // Asegúrate de importar Carbon

class Course extends Model
{
    protected $fillable = [
        'name',
        'schedule',
        'start_date',
        'end_date',
    ];

    // Añadir la propiedad casts
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function getStudentCountAttribute(): int
    {
        return $this->students()->count();
    }
}

