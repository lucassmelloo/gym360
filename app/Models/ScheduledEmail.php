<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduledEmail extends Model
{
    protected $guarded = [];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function recipient_email(): BelongsTo
    {
        return $this->belongsTo(RecipientEmail::class);
    }

    public function email_logs()
    {
        return $this->hasMany(EmailLog::class);
    }

    public function othersRecipients(): array
    {
        return explode(';', $this->others_recipients);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isSent(): bool
    {
        return $this->status === 'sent';
    }

    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    public function markAsSent(): void
    {
        $this->update(['status' => 'sent']);
    }

    public function markAsFailed(): void
    {
        $this->update(['status' => 'failed']);
    }

    public function markAsPending(): void
    {
        $this->update(['status' => 'pending']);
    }

    public function getRecipients()
    {
        // Recupera os emails com base no tipo de destinatário
        $recipientEmails = $this->recipient_email->getEmails() ?? [];

        // Se houver outros destinatários, adiciona-os
        $otherRecipients = $this->others_recipients
            ? array_map('trim', explode(';', $this->others_recipients))
            : [];

        // Faz o merge e remove duplicados
        return array_unique(array_merge($recipientEmails, $otherRecipients));
    }
}
