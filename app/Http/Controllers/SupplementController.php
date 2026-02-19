<?php

namespace App\Http\Controllers;

use App\Models\Supplement;
use Illuminate\Http\Request;

class SupplementController extends Controller
{
    /**
     * List all supplements
     */
    public function index()
    {
        $supplements = Supplement::orderBy('name')->get();

        return response()->json([
            'supplements' => $supplements
        ]);
    }

    /**
     * Store a new supplement (admin later)
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'                => 'required|string|max:255',
            'daily_dose'          => 'nullable|string|max:100',
            'price'               => 'nullable|numeric|min:0',
            'testosterone_boost'  => 'nullable|boolean',
            'description'         => 'nullable|string',
            'image_url'           => 'nullable|string|max:500'
        ]);

        $supplement = Supplement::create($data);

        return response()->json([
            'message'    => 'Supplement created successfully',
            'supplement' => $supplement
        ], 201);
    }
}
