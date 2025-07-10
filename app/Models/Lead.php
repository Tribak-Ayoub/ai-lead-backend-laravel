<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'status',
        'qualification',
        'last_call_at',
        'call_attempts',
    ];

    // A Lead has many call sessions
    public function callSessions()
    {
        return $this->hasMany(CallSession::class);
    }

    // A Lead has many queued calls
    public function callQueues()
    {
        return $this->hasMany(CallQueue::class);
    }
}
