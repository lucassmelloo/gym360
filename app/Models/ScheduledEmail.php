<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledEmail extends Model
{
    protected $fillable = [
        'subject',
        'body',
        'recipients',
        'scheduled_at',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function recipients()
    {
        return $this->belongsTo(RecipientEmail::class);
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

    public function getAllRecipientsAttribute()
    {
        return array_merge([$this->recipients->pluck()], $this->othersRecipients());
    }
}
