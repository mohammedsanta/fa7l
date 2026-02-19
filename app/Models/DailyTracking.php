<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTracking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sleep_hours',
        'sleep_quality',
        'mood',
        'notes',
        'tracked_date',
    ];

    protected $casts = [
        'data' => 'array',
    ];

}
