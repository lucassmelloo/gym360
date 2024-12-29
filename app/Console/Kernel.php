<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Registra comandos do console.
     */
    protected $commands = [
        //
    ];

    /**
     * Define as tarefas agendadas.
     */
    protected function schedule(Schedule $schedule)
    {
        // Processa os emails agendados
        $schedule->call(function () {
            $emails = \App\Models\ScheduledEmail::where('status', 'pending')
                ->where('scheduled_at', '<=', now())
                ->get();

            foreach ($emails as $email) {
                \App\Jobs\SendScheduledEmail::dispatch($email);
            }
        })->everyMinute();
    }

    /**
     * Registra comandos customizados.
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
