<?php

// app/Models/Lead.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\LeadStatus;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'status',
        'qualification',
        'last_call_at',
        'call_attempts',
        'campaign_id'
    ];

    protected $casts = [
        'status' => LeadStatus::class,
        'last_call_at' => 'datetime',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function callSessions()
    {
        return $this->hasMany(CallSession::class);
    }

    public function callQueues()
    {
        return $this->hasMany(CallQueue::class);
    }
}
