<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestosteroneTest extends Model
{
    protected $fillable = [
        'user_id',
        'level',
        'unit',    // ng/dL
        'date'
    ];

    protected $casts = [
        'date' => 'date'
    ];
}
