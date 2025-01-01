<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $emails;
    public string $subject;
    public $body;

    /**
     * Create a new job instance.
     */
    public function __construct($emails, $subject, $body)
    {
        $this->emails = $emails;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        foreach ($this->emails as $email) {
            Mail::to($email)->send(new \App\Mail\CustomEmail($this->subject, $this->body));
        }
    }
}
