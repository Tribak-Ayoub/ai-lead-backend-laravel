<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallQueue extends Model
{
    use HasFactory;
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
