<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPreference;

class UserPreferenceController extends Controller
{
    public function index()
    {
        return response()->json(
            UserPreference::where('user_id', auth()->id())->first()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'sleep_goal_hours' => 'nullable|numeric',
            'notifications_enabled' => 'boolean',
            'language' => 'string',
            'theme' => 'string',
        ]);

        $pref = UserPreference::updateOrCreate(
            ['user_id' => auth()->id()],
            $data
        );

        return response()->json($pref);
    }
}
