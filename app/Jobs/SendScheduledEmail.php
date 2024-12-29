<?php

namespace App\Jobs;

use App\Models\ScheduledEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendScheduledEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $scheduledEmail;

    /**
     * Create a new job instance.
     */
    public function __construct(ScheduledEmail $scheduledEmail)
    {
        $this->scheduledEmail = $scheduledEmail;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Enviar email para os destinatários
        $recipients = explode(',', $this->scheduledEmail->others_recipients);
        
        foreach ($recipients as $email) {
            Mail::send([], [], function ($message) use ($email) {
                $message->to(trim($email))
                    ->subject($this->scheduledEmail->subject)
                    ->html($this->scheduledEmail->body);
            });
        }

        dd('lucas');
        // Atualizar status do email para "enviado"
        //$this->scheduledEmail->markAsSent();
    }
}
