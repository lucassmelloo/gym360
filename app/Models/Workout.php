<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Workout extends Model
{

    protected $guarded = [];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function workout_type() : BelongsTo
    {
        return $this->belongsTo(WorkoutType::class);
    }

    public function workout_divisions() : HasMany
    {
        return $this->hasMany(WorkoutDivision::class);
    }

}
