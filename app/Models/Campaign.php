<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'phone',
    'status',
    'assignedLeads',
    'conversionRate',
    'leadsQualified'
    ];


    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function intents()
    {
        return $this->hasMany(Intent::class);
    }
}

