<?php

namespace App\Http\Controllers;

use App\Models\TestosteroneTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestosteroneTestController extends Controller
{
    /**
     * Store a new testosterone test
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'date'  => 'required|date',
            'level' => 'required|numeric|min:0',
            'note'  => 'nullable|string'
        ]);

        $test = TestosteroneTest::create([
            'user_id' => Auth::id(),
            ...$data
        ]);

        return response()->json([
            'message' => 'Testosterone test recorded',
            'data'    => $test
        ], 201);
    }

    /**
     * List all testosterone tests for user
     */
    public function index()
    {
        $tests = TestosteroneTest::where('user_id', Auth::id())
            ->orderBy('date', 'desc')
            ->get();

        return response()->json([
            'tests' => $tests
        ]);
    }

    /**
     * Show specific testosterone test
     */
    public function show($id)
    {
        $test = TestosteroneTest::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return response()->json([
            'test' => $test
        ]);
    }
}
