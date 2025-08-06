<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\IntentSource;

class Intent extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id', 'name', 'description', 'category',
        'keywords', 'phrases', 'confidence_threshold', 'is_active',
        'source', 'usage_count'
    ];

    protected $casts = [
        'keywords' => 'array',
        'phrases' => 'array',
        'source' => IntentSource::class,
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function trainings()
    {
        return $this->hasMany(IntentTraining::class);
    }
}
