<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipientEmail extends Model
{
    protected $guarded = [];

    public function scheduledEmails()
    {
        return $this->hasMany(ScheduledEmail::class);
    }

    public function getEmails()
    {
        return match ($this->name) {
            'all_students' => \App\Models\Student::pluck('email')->toArray(),
            'all_users' => \App\Models\User::pluck('email')->toArray(),
            'all_students_and_users' => \App\Models\Student::pluck('email')
                ->merge(\App\Models\User::pluck('email'))
                ->toArray(),
            'none' => [],
            default => [],
        };
    }
}
