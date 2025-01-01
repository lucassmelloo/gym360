<?php

use App\Models\ScheduledEmail;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::call(function () {
    $emails = \App\Models\ScheduledEmail::where('status', 'pending')
        ->where('scheduled_at', '<=', now())
        ->get();

    foreach ($emails as $email) {
        \App\Jobs\SendScheduledEmail::dispatch($email);
    }
})->everyMinute();
