<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    /**
     * List all workouts
     */
    public function index()
    {
        return response()->json([
            'workouts' => Workout::orderBy('name')->get()
        ]);
    }

    /**
     * Store new workout (admin later)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:255',
            'category'        => 'nullable|string|max:100',
            'testosterone_boost' => 'nullable|boolean',
            'description'     => 'nullable|string',
        ]);

        $workout = Workout::create($data);

        return response()->json([
            'message' => 'Workout created successfully',
            'workout' => $workout
        ], 201);
    }
}
