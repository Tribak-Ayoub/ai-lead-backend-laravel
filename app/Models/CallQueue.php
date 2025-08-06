<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\QueueStatus;
use App\Enums\Priority;

class CallQueue extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id', 'priority', 'scheduled_time', 'status', 'retry_count', 'max_retries'
    ];

    protected $casts = [
        'priority' => Priority::class,
        'status' => QueueStatus::class,
        'scheduled_time' => 'datetime'
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}

