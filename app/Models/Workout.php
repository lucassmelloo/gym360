<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    protected $guarded = [];

    protected $dates = ['start_date', 'due_date'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function principal_students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function workout_type(): BelongsTo
    {
        return $this->belongsTo(WorkoutType::class);
    }

    public function workout_divisions(): HasMany
    {
        return $this->hasMany(WorkoutDivision::class);
    }
}
