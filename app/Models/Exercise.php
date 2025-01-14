<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Exercise extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    public function muscles()
    {
        return $this->belongsToMany(Muscle::class);
    }

    public function workout_division_exercises(): HasMany
    {
        return $this->hasMany(WorkoutDivisionExercise::class);
    }

    protected function muscleNames(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => is_string(data_get($attributes, 'muscles'))
                ? json_decode($attributes['muscles'], true)
                : data_get($attributes, 'muscles'),
        );
    }
}
