<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkoutModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function workout_type() : BelongsTo
    {
        return $this->belongsTo(WorkoutType::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
