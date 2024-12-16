<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Method extends Model
{
    protected $guarded = [];

    public function workout_division_exercises() : HasMany
    {
        return $this->hasMany(WorkoutDivisionExercise::class);
    }

}
