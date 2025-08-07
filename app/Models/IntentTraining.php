<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\TrainingSource;

class IntentTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'intent_id', 'training_phrase', 'is_positive', 'source'
    ];

    protected $casts = [
        'is_positive' => 'boolean',
        'source' => TrainingSource::class,
    ];

    public function intent()
    {
        return $this->belongsTo(Intent::class);
    }
}

