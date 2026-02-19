<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\DailyTracking;

class DashboardController extends Controller
{
    public function summary()
    {
        return DailyTracking::where('user_id', Auth::id())
            ->latest()
            ->take(10)
            ->get();
    }

    public function weekly()
    {
        return DailyTracking::where('user_id', Auth::id())
            ->whereBetween('date', [now()->subWeek(), now()])
            ->get();
    }

    public function monthly()
    {
        return DailyTracking::where('user_id', Auth::id())
            ->whereMonth('date', now()->month)
            ->get();
    }
}
