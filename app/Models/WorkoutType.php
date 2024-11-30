<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkoutType extends Model
{

    protected $guarded = [];

    public function workout_type() : HasMany
    {
        return $this->hasMany(WorkoutModel::class);
    }
}
