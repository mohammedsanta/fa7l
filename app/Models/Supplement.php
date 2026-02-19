<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    protected $fillable = [
        'name',
        'type',     // vitamin | mineral | hormone
        'dosage'
    ];
}
