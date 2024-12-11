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

    public function attendances() : HasMany
    {
        return $this->hasMany(Attendance::class);
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
    if (!$this->date_of_birth) {
        return null;
    }

    $today = now();
    $nextBirthday = $this->date_of_birth->copy()->setYear($today->year);

    // Ajusta para o próximo ano se o aniversário já passou
    if ($nextBirthday->isPast() && !$nextBirthday->isToday()) {
        $nextBirthday->addYear();
    }

    // Verifica se o aniversário é hoje
    if ($nextBirthday->isToday()) {
        return "Hoje é aniversário de {$this->name}!";
    }

    $daysUntil = $today->diffInDays($nextBirthday);

    if ($daysUntil <= 5) {
        return "Faltam {$daysUntil} dias para o aniversário de {$this->name}.";
    }

    return null;
}

}
