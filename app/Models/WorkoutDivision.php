<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutDivision extends Model
{

    protected $guarded = [];

    public function workout() : BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }
}
