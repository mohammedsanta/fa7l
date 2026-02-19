<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyWorkout extends Model
{
    protected $fillable = [
        'user_id',
        'workout_id',
        'date',
        'duration'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
