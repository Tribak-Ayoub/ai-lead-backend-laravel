<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallSession extends Model
{
    use HasFactory;
    protected $fillable = [
        'lead_id',
        'start_time',
        'end_time',
        'outcome',
        'audio_file_path',
        'status',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public function conversationSummary()
    {
        return $this->hasOne(ConversationSummary::class);
    }

    public function conversationTurns()
    {
        return $this->hasMany(ConversationTurn::class);
    }
}
