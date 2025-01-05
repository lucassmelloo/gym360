<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    protected $guarded = [];

    protected $dates = ['start_date', 'due_date'];

    protected $casts = [
        'due_date' => 'date',
    ];

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

    public function workout_division_exercises(): HasMany
    {
        return $this->hasMany(WorkoutDivisionExercise::class);
    }

    public function message_until_due_date(): ?string
    {
        $today = now()->startOf('day');
        $due_date = $this->due_date->startOf('day');

        if($today->diffInDays($due_date) == 0) {
            return 'O treino vence hoje.';
        }
        if($today->diffInDays($due_date) < 0) {
            return 'O treino está vencido.';
        }
        if($today->diffInDays($due_date) <= 5) {
            return 'Faltam ' . $today->diffInDays($due_date) . ' dias para o vencimento do Treino.';
        }

        return null;
    }

    public function days_until_due_date(): ?int
    {
        $today = now()->startOf('day');
        $due_date = $this->due_date->startOf('day');


        if($today->diffInDays($due_date) <= 5) {
            return $today->diffInDays($due_date);
        }

        return null;
    }
}
