<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationSummary extends Model
{
    use HasFactory;
    protected $fillable = [
        'call_session_id',
        'key_intents',
        'final_response',
        'qualification_notes',
        'overall_sentiment',
    ];

    protected $casts = [
        'key_intents' => 'array',
        'overall_sentiment' => 'float',
    ];

    public function callSession()
    {
        return $this->belongsTo(CallSession::class);
    }
}
