<?php

namespace App\Http\Controllers;

use App\Models\DailyFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyFoodController extends Controller
{
    /**
     * Store daily food intake
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'food_id' => 'required|exists:foods,id',
            'date'    => 'required|date',
            'quantity'=> 'nullable|numeric|min:0',
            'notes'   => 'nullable|string'
        ]);

        $exists = DailyFood::where('user_id', Auth::id())
            ->where('food_id', $data['food_id'])
            ->where('date', $data['date'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Food already logged for this day'
            ], 422);
        }

        $dailyFood = DailyFood::create([
            'user_id' => Auth::id(),
            ...$data
        ]);

        return response()->json([
            'message' => 'Food logged successfully',
            'data'    => $dailyFood
        ], 201);
    }

    /**
     * List daily foods by date
     */
    public function index($date)
    {
        $foods = DailyFood::with('food')
            ->where('user_id', Auth::id())
            ->where('date', $date)
            ->get();

        return response()->json([
            'date'  => $date,
            'foods' => $foods
        ]);
    }

    /**
     * Delete daily food
     */
    public function destroy($id)
    {
        $food = DailyFood::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $food->delete();

        return response()->json([
            'message' => 'Food removed'
        ]);
    }
}
