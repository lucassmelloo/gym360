<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkoutDivision extends Model
{

    protected $guarded = [];

    public function workout() : BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }

    public function workout_division_exercises() : HasMany
    {
        return $this->hasMany(WorkoutDivisionExercise::class);
    }
}
