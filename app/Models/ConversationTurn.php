<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConversationTurn extends Model
{
    use HasFactory;

    protected $fillable = [
        'call_session_id', 'turn_number', 'transcript',
        'intent_id', 'confidence', 'ai_response',
        'audio_file_path', 'is_user_message', 'needs_review'
    ];

    protected $casts = [
        'is_user_message' => 'boolean',
        'needs_review' => 'boolean',
        'confidence' => 'float'
    ];

    public function callSession()
    {
        return $this->belongsTo(CallSession::class);
    }

    public function intent()
    {
        return $this->belongsTo(Intent::class);
    }
}

