<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyExerciseCheck;

class DailyExerciseCheckController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'date'      => 'required|date',
            'name'      => 'required|string',
            'duration'  => 'nullable|integer',
            'completed' => 'required|boolean'
        ]);

        $data['user_id'] = Auth::id();

        return DailyExerciseCheck::create($data);
    }

    public function show($date)
    {
        return DailyExerciseCheck::where('user_id', Auth::id())
            ->where('date', $date)
            ->get();
    }
}
