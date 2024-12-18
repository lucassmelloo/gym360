<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $dates = ['date_of_birth'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }

    public function workouts(): HasMany
    {
        return $this->hasMany(Workout::class);
    }

    public function principal_workout()
    {
        return $this->belongsTo(Workout::class, 'workout_id');
    }

    public static function missingOnDate($date = null)
    {
        $date = $date ?? now()->toDateString();

        return static::whereDoesntHave('attendances', function ($query) use ($date) {
            $query->whereDate('attendance_date', $date);
        })->get();
    }

    public function daysUntilBirthday(): ?string
    {
        if (! $this->date_of_birth) {
            return null;
        }

        // Normalizar para garantir que apenas a data (sem horas) seja considerada
        $today = now()->startOfDay();
        $dateOfBirth = $this->date_of_birth->copy()->startOfDay();

        // Determinar o próximo aniversário
        $nextBirthday = $dateOfBirth->setYear($today->year);

        // Ajustar para o próximo ano se o aniversário já passou
        if ($nextBirthday->lessThan($today)) {
            $nextBirthday->addYear();
        }

        // Verificar se é hoje
        if ($nextBirthday->isToday()) {
            return "Hoje é aniversário de {$this->name}!";
        }

        // Calcular diferença em dias
        $daysUntil = $today->diffInDays($nextBirthday);

        if ($daysUntil == 1) {
            return "Falta {$daysUntil} dia para o aniversário de {$this->name}.";
        }

        if ($daysUntil <= 5) {
            return "Faltam {$daysUntil} dias para o aniversário de {$this->name}.";
        }

        return null;
    }
}
