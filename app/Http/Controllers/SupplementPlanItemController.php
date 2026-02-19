<?php

namespace App\Http\Controllers;

use App\Models\SupplementPlanItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplementPlanItemController extends Controller
{
    /**
     * Add a supplement to a monthly plan
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'plan_id'       => 'required|exists:supplement_plans,id',
            'supplement_id' => 'required|exists:supplements,id',
            'quantity'      => 'nullable|string|max:50',
            'notes'         => 'nullable|string'
        ]);

        // Check ownership of plan
        $plan = $request->user()->supplementPlans()->find($data['plan_id']);
        if (!$plan) {
            return response()->json([
                'message' => 'Plan not found or not owned by user'
            ], 403);
        }

        // Prevent duplicate supplement in same plan
        $exists = SupplementPlanItem::where('supplement_plan_id', $data['plan_id'])
            ->where('supplement_id', $data['supplement_id'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Supplement already added to this plan'
            ], 422);
        }

        $item = SupplementPlanItem::create([
            'supplement_plan_id' => $data['plan_id'],
            'supplement_id'      => $data['supplement_id'],
            'quantity'           => $data['quantity'] ?? null,
            'notes'              => $data['notes'] ?? null
        ]);

        return response()->json([
            'message' => 'Supplement added to plan',
            'data'    => $item
        ], 201);
    }

    /**
     * Delete a supplement from plan
     */
    public function destroy($id)
    {
        $item = SupplementPlanItem::findOrFail($id);

        // Check ownership via plan
        if ($item->plan->user_id != Auth::id()) {
            return response()->json([
                'message' => 'Not authorized'
            ], 403);
        }

        $item->delete();

        return response()->json([
            'message' => 'Supplement removed from plan'
        ]);
    }
}
