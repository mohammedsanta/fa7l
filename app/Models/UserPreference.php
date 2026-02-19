<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    protected $fillable = [
        'user_id',
        'track_workouts',
        'track_food',
        'track_supplements',
        'track_sleep',
        'track_testosterone'
    ];
}
