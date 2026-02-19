<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplementPlanItem extends Model
{
    protected $fillable = [
        'supplement_plan_id',
        'supplement_id',
        'dosage',
        'time'   // morning | night
    ];
}
