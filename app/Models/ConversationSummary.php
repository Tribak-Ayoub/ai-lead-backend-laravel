<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConversationSummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'call_session_id', 'key_intents', 'final_response', 'qualification_notes', 'overall_sentiment'
    ];

    protected $casts = [
        'key_intents' => 'array',
    ];

    public function callSession()
    {
        return $this->belongsTo(CallSession::class);
    }
}

