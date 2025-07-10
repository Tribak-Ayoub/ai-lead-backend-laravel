<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intent extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'category',
        'keywords',
        'phrases',
        'confidence_threshold',
        'is_active',
        'source',
        'usage_count',
    ];

    protected $casts = [
        'keywords' => 'array',
        'phrases' => 'array',
        'confidence_threshold' => 'float',
        'is_active' => 'boolean',
    ];

    public function intentTrainings()
    {
        return $this->hasMany(IntentTraining::class);
    }
}
