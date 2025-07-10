<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntentTraining extends Model
{
    use HasFactory;
    protected $fillable = [
        'intent_id',
        'training_phrase',
        'is_positive',
        'user_id',
        'source',
    ];

    public function intent()
    {
        return $this->belongsTo(Intent::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
