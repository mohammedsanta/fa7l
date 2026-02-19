<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyFood extends Model
{

    public $table = 'daily_foods';

    protected $fillable = [
        'user_id',
        'food_id',
        'date',
        'quantity'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
