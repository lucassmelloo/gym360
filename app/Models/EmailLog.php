<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $guarded = [];

    public function scheduledEmail()
    {
        return $this->belongsTo(ScheduledEmail::class);
    }
}
