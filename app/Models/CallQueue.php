<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallQueue extends Model
{
    protected $fillable = [
        'lead_id',
        'priority',
        'scheduled_time',
        'status',
        'retry_count',
        'max_retries',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
