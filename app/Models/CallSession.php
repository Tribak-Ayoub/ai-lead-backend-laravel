<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\CallStatus;

class CallSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id', 'start_time', 'end_time', 'outcome', 'status'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'status' => CallStatus::class,
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function summary()
    {
        return $this->hasOne(ConversationSummary::class);
    }

    public function turns()
    {
        return $this->hasMany(ConversationTurn::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
}
