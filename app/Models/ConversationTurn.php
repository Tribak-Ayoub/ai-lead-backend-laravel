<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationTurn extends Model
{
    use HasFactory;
    protected $fillable = [
        'call_session_id',
        'turn_number',
        'transcript',
        'detected_intent_id',
        'confidence',
        'ai_response',
        'is_user_message',
        'needs_review',
    ];

    public function callSession()
    {
        return $this->belongsTo(CallSession::class);
    }

    public function intent()
    {
        return $this->belongsTo(Intent::class, 'detected_intent_id');
    }
}
