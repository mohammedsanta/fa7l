<?php

namespace App\Http\Controllers;

use App\Models\DailyWorkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyWorkoutController extends Controller
{
    /**
     * Store daily workout
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'workout_id' => 'required|exists:workouts,id',
            'date'       => 'required|date',
            'duration'   => 'nullable|integer|min:1',
            'intensity'  => 'nullable|string|max:50',
            'notes'      => 'nullable|string',
        ]);

        $exists = DailyWorkout::where('user_id', Auth::id())
            ->where('workout_id', $data['workout_id'])
            ->where('date', $data['date'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Workout already logged for this day'
            ], 422);
        }

        $dailyWorkout = DailyWorkout::create([
            'user_id' => Auth::id(),
            ...$data
        ]);

        return response()->json([
            'message' => 'Workout logged successfully',
            'data'    => $dailyWorkout
        ], 201);
    }

    /**
     * List daily workouts by date
     */
    public function index($date)
    {
        $workouts = DailyWorkout::with('workout')
            ->where('user_id', Auth::id())
            ->where('date', $date)
            ->get();

        return response()->json([
            'date'     => $date,
            'workouts' => $workouts
        ]);
    }

    /**
     * Delete daily workout
     */
    public function destroy($id)
    {
        $workout = DailyWorkout::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $workout->delete();

        return response()->json([
            'message' => 'Workout removed'
        ]);
    }
}
