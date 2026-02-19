<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailySupplement extends Model
{
    protected $fillable = [
        'user_id',
        'supplement_id',
        'date',
        'amount'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
