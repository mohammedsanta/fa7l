<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyExerciseCheck extends Model
{

    public $table = 'daily_exercises_check';

    protected $fillable = [
        'user_id',
        'date',
        'worked_out', // true / false
        'notes'
    ];

    protected $casts = [
        'date' => 'date',
        'worked_out' => 'boolean'
    ];
}
