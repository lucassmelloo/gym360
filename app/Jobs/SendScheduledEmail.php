<?php

namespace App\Jobs;

use App\Models\ScheduledEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Log\Logger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
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
        // Obter os destinatários
        $emails = $this->scheduledEmail->getRecipients();

        foreach ($emails as $email) {
            try {

                Mail::send([], [], function ($message) use ($email) {
                    $message->to(trim($email))
                        ->subject($this->scheduledEmail->subject)
                        ->html(
                            view('emails.default',['body' => $this->scheduledEmail->body])->render()
                        );
                });

                // Registrar log de sucesso para este destinatário
                \App\Models\EmailLog::create([
                    'scheduled_email_id' => $this->scheduledEmail->id,
                    'recipient' => $email,
                    'status' => 'success',
                ]);
            } catch (\Exception $e) {
                // Registrar log de falha para este destinatário
                \App\Models\EmailLog::create([
                    'scheduled_email_id' => $this->scheduledEmail->id,
                    'recipient' => $email,
                    'status' => 'failed',
                    'error_message' => $e->getMessage(),
                ]);

                // Você pode optar por não parar todo o processo ao encontrar erros, mas registrar o problema.
                continue;
            }
        }
        // Atualizar status geral do email agendado
        if ($this->scheduledEmail->email_logs->contains('status', 'failed')) {
            $this->scheduledEmail->markAsFailed();
        } else {
            $this->scheduledEmail->markAsSent();
        }
    }
}
