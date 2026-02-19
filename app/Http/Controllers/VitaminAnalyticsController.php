<?php

namespace App\Http\Controllers;

use App\Models\DailyTracking;
use Illuminate\Support\Facades\Auth;

class VitaminAnalyticsController extends Controller
{
    /**
     * Generate weekly vitamin report
     */
    public function weeklyReport()
    {
        $userId = Auth::id();
        $startOfWeek = now()->subDays(6)->startOfDay();
        $endOfWeek = now()->endOfDay();

        // جلب جميع تتبعات المكملات والفيتامينات خلال الأسبوع
        $vitamins = DailyTracking::where('user_id', $userId)
            ->where('type', 'supplement')
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->get();

        $summary = [];

        foreach ($vitamins as $v) {
            foreach ($v->data as $vitaminName => $amount) {
                if (!isset($summary[$vitaminName])) {
                    $summary[$vitaminName] = 0;
                }
                $summary[$vitaminName] += $amount; // جمع الكمية الأسبوعية
            }
        }

        // مثال لمستوى الفيتامين المطلوب يومياً (يمكن تخصيصه حسب النظام)
        $recommendedDaily = [
            'Vitamin C'  => 100,
            'Vitamin D'  => 10,
            'Zinc'       => 15,
            'Magnesium'  => 400,
            'Iron'       => 18
        ];

        $weeklyReport = [];

        foreach ($recommendedDaily as $vit => $daily) {
            $weeklyTotal = $summary[$vit] ?? 0;
            $weeklyRecommended = $daily * 7;

            $weeklyReport[$vit] = [
                'total_intake'   => $weeklyTotal,
                'recommended'    => $weeklyRecommended,
                'status'         => $weeklyTotal >= $weeklyRecommended ? 'sufficient' : 'insufficient'
            ];
        }

        return response()->json([
            'week_start' => $startOfWeek->toDateString(),
            'week_end'   => now()->toDateString(),
            'report'     => $weeklyReport
        ]);
    }
}
