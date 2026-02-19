<?php

namespace App\Http\Controllers;

use App\Models\DailySupplement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailySupplementController extends Controller
{
    /**
     * Store daily supplement intake
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'supplement_id' => 'required|exists:supplements,id',
            'date'          => 'required|date',
            'quantity'      => 'nullable|string|max:50',
            'notes'         => 'nullable|string'
        ]);

        $exists = DailySupplement::where('user_id', Auth::id())
            ->where('supplement_id', $data['supplement_id'])
            ->where('date', $data['date'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Supplement already logged for this day'
            ], 422);
        }

        $dailySupplement = DailySupplement::create([
            'user_id' => Auth::id(),
            ...$data
        ]);

        return response()->json([
            'message' => 'Supplement logged successfully',
            'data'    => $dailySupplement
        ], 201);
    }

    /**
     * List daily supplements by date
     */
    public function index($date)
    {
        $supplements = DailySupplement::with('supplement')
            ->where('user_id', Auth::id())
            ->where('date', $date)
            ->get();

        return response()->json([
            'date'        => $date,
            'supplements' => $supplements
        ]);
    }

    /**
     * Delete daily supplement
     */
    public function destroy($id)
    {
        $supplement = DailySupplement::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $supplement->delete();

        return response()->json([
            'message' => 'Supplement removed'
        ]);
    }
}
