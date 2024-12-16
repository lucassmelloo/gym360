<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutDivisionExercise extends Model
{
    protected $guarded = [];

    // $table->foreignIdFor(User::class)->constrained();
    // $table->foreingIdFor(Method::class)->constrained();
    // $table->foreingIdFor(Exercise::class)->constrained();


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function method(): BelongsTo
    {
        return $this->belongsTo(Method::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    public function workout_division(): BelongsTo
    {
        return $this->belongsTo(WorkoutDivision::class);
    }
}
