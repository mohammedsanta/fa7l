<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DailyTracking;

class AnalyticsController extends Controller
{
    public function testosteroneScore()
    {
        $sleep = DailyTracking::where('user_id', Auth::id())
            ->where('type', 'sleep')
            ->avg('data->hours');

        return [
            'score' => round($sleep * 10)
        ];
    }

    public function restLazyEvaluation()
    {
        $workouts = DailyTracking::where('user_id', Auth::id())
            ->where('type', 'workout')
            ->count();

        return [
            'status' => $workouts >= 3 ? 'active' : 'lazy'
        ];
    }
}
