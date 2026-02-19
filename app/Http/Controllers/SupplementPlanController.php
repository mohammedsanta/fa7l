<?php

namespace App\Http\Controllers;

use App\Models\SupplementPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplementPlanController extends Controller
{
    /**
     * Store a new monthly supplement plan
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'month' => 'required|integer|min:1|max:12',
            'year'  => 'required|integer|min:2000',
            'title' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $plan = SupplementPlan::create([
            'user_id' => Auth::id(),
            ...$data
        ]);

        return response()->json([
            'message' => 'Supplement plan created',
            'data'    => $plan
        ], 201);
    }

    /**
     * Show user's supplement plan for a specific month
     */
    public function show($month, $year)
    {
        $plan = SupplementPlan::with('items.supplement')
            ->where('user_id', Auth::id())
            ->where('month', $month)
            ->where('year', $year)
            ->first();

        if (!$plan) {
            return response()->json([
                'message' => 'No plan found for this month'
            ], 404);
        }

        return response()->json([
            'plan' => $plan
        ]);
    }
}
