<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyTracking;

class TrackingController extends Controller
{
    private function storeTracking($type, $date, array $data)
    {
        $userId = Auth::id();

        $exists = DailyTracking::where('user_id', $userId)
            ->where('date', $date)
            ->where('type', $type)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Already logged today'
            ], 422);
        }

        return DailyTracking::create([
            'user_id' => $userId,
            'date'    => $date,
            'type'    => $type,
            'data'    => $data
        ]);
    }

    public function sleep(Request $request)
    {
        $request->validate([
            'date'    => 'required|date',
            'hours'   => 'required|numeric|min:0|max:24',
            'quality' => 'nullable|string'
        ]);

        return $this->storeTracking('sleep', $request->date, $request->only('hours', 'quality'));
    }

    public function water(Request $request)
    {
        $request->validate([
            'date'  => 'required|date',
            'cups'  => 'required|integer|min:0'
        ]);

        return $this->storeTracking('water', $request->date, $request->only('cups'));
    }

    public function workout(Request $request)
    {
        $request->validate([
            'date'      => 'required|date',
            'type'      => 'required|string',
            'duration'  => 'required|integer',
            'intensity' => 'nullable|string'
        ]);

        return $this->storeTracking('workout', $request->date, $request->all());
    }

    public function mood(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'mood' => 'required|string',
            'note' => 'nullable|string'
        ]);

        return $this->storeTracking('mood', $request->date, $request->only('mood', 'note'));
    }

    public function reading(Request $request)
    {
        $request->validate([
            'date'    => 'required|date',
            'minutes' => 'required|integer|min:0'
        ]);

        return $this->storeTracking('reading', $request->date, $request->only('minutes'));
    }

    public function meditation(Request $request)
    {
        $request->validate([
            'date'    => 'required|date',
            'minutes' => 'required|integer|min:0'
        ]);

        return $this->storeTracking('meditation', $request->date, $request->only('minutes'));
    }

    public function quran(Request $request)
    {
        $request->validate([
            'date'  => 'required|date',
            'pages' => 'required|integer|min:0'
        ]);

        return $this->storeTracking('quran', $request->date, $request->only('pages'));
    }

    public function scrolling(Request $request)
    {
        $request->validate([
            'date'    => 'required|date',
            'minutes' => 'required|integer|min:0'
        ]);

        return $this->storeTracking('scrolling', $request->date, $request->only('minutes'));
    }

    public function faceExercise(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'done' => 'required|boolean'
        ]);

        return $this->storeTracking('face_exercise', $request->date, $request->only('done'));
    }

    public function achievement(Request $request)
    {
        $request->validate([
            'date'  => 'required|date',
            'title' => 'required|string'
        ]);

        return $this->storeTracking('achievement', $request->date, $request->only('title'));
    }

    public function todayStatus()
    {
        $today = now()->toDateString();

        $types = DailyTracking::where('user_id', Auth::id())
            ->where('date', $today)
            ->pluck('type');

        return response()->json($types->mapWithKeys(fn ($t) => [$t => true]));
    }

    public function weeklySummary()
    {
        return DailyTracking::where('user_id', Auth::id())
            ->whereBetween('date', [now()->subDays(6), now()])
            ->get();
    }
}
