<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * List all foods
     */
    public function index()
    {
        return response()->json([
            'foods' => Food::orderBy('name')->get()
        ]);
    }

    /**
     * Store new food (admin later)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'protein'       => 'nullable|numeric|min:0',
            'carbs'         => 'nullable|numeric|min:0',
            'fat'           => 'nullable|numeric|min:0',
            'calories'      => 'nullable|numeric|min:0',
            'testosterone_boost' => 'nullable|boolean',
        ]);

        $food = Food::create($data);

        return response()->json([
            'message' => 'Food created successfully',
            'food'    => $food
        ], 201);
    }
}
