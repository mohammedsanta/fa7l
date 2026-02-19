<?php

// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    User,
    UserPreference,
    DailyTracking,
    DailyExerciseCheck,
    Workout,
    DailyWorkout,
    Food,
    DailyFood,
    DailyLog,
    Supplement,
    DailySupplement,
    SupplementPlan,
    SupplementPlanItem,
    TestosteroneTest
};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

        /*
        |--------------------------------------------------------------------------
        | USER PREFERENCES
        |--------------------------------------------------------------------------
        */
        UserPreference::create([
            'user_id' => $user->id,
            'track_sleep' => true,
            'track_water' => true,
            'track_workout' => true,
            'track_mood' => true,
            'track_quran' => true,
            'track_scrolling' => true,
        ]);

        /*
        |--------------------------------------------------------------------------
        | WORKOUTS
        |--------------------------------------------------------------------------
        */
        $push = Workout::create([
            'name' => 'Push Day',
            // 'description' => 'Chest, Shoulder, Triceps',
        ]);

        $pull = Workout::create([
            'name' => 'Pull Day',
            // 'description' => 'Back, Biceps',
        ]);

        /*
        |--------------------------------------------------------------------------
        | FOODS
        |--------------------------------------------------------------------------
        */
        $chicken = Food::create([
            'name' => 'Chicken Breast',
            'calories' => 165,
        ]);

        $rice = Food::create([
            'name' => 'Rice',
            'calories' => 130,
        ]);

        /*
        |--------------------------------------------------------------------------
        | SUPPLEMENTS
        |--------------------------------------------------------------------------
        */
        $vitaminD = Supplement::create([
            'name' => 'Vitamin D3',
            'dose' => '5000 IU',
            'focus' => 'Hormones & Bones',
        ]);

        $zinc = Supplement::create([
            'name' => 'Zinc',
            'dose' => '30 mg',
            'focus' => 'Testosterone',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SUPPLEMENT PLAN
        |--------------------------------------------------------------------------
        */
        $plan = SupplementPlan::create([
            'user_id' => $user->id,
            'month' => now()->month,
            'year' => now()->year,
            'budget' => 1000,
        ]);

        SupplementPlanItem::create([
            'supplement_plan_id' => $plan->id,
            'supplement_id' => $vitaminD->id,
            'pills_per_day' => 1,
            'price' => 300,
        ]);

        SupplementPlanItem::create([
            'supplement_plan_id' => $plan->id,
            'supplement_id' => $zinc->id,
            'pills_per_day' => 1,
            'price' => 250,
        ]);

        /*
        |--------------------------------------------------------------------------
        | DAILY DATA (LAST 3 DAYS)
        |--------------------------------------------------------------------------
        */
        foreach ([0, 1, 2] as $day) {

            $date = now()->subDays($day)->toDateString();

            // Daily Tracking
            DailyTracking::create([
                'user_id' => $user->id,
                'date' => $date,
                'type' => 'sleep',
                'data' => [
                    'hours' => 7,
                    'quality' => 'good'
                ]
            ]);

            DailyTracking::create([
                'user_id' => $user->id,
                'date' => $date,
                'type' => 'water',
                'data' => [
                    'cups' => 8
                ]
            ]);

            DailyTracking::create([
                'user_id' => $user->id,
                'date' => $date,
                'type' => 'quran',
                'data' => [
                    'pages' => 4
                ]
            ]);

            DailyTracking::create([
                'user_id' => $user->id,
                'date' => $date,
                'type' => 'scrolling',
                'data' => [
                    'minutes' => 90
                ]
            ]);

$dailyLog = DailyLog::firstOrCreate([
    'user_id' => $user->id,
    'log_date' => $date,
]);

DailyExerciseCheck::create([
    'user_id' => $user->id,
    'daily_log_id' => $dailyLog->id, // مهم جداً
    'date' => $date,
    'status' => $day === 1 ? 'rest' : 'trained',
    'reason' => $day === 1 ? 'Recovery day' : null,
]);

$dailyLog = DailyLog::firstOrCreate([
    'user_id' => $user->id,
    'log_date' => $date,
]);

DailyWorkout::create([
    'user_id' => $user->id,
    'daily_log_id' => $dailyLog->id,  // مهم جدًا
    'workout_id' => $push->id,
    'date' => $date,
    'duration' => 60,
]);

            // Daily Food
            DailyFood::create([
                'user_id' => $user->id,
                'daily_log_id' => $dailyLog->id,  // مهم جدًا
                'food_id' => $chicken->id,
                'date' => $date,
                'quantity' => 200,
            ]);

            // Daily Supplement
            DailySupplement::create([
                'user_id' => $user->id,
                'supplement_id' => $vitaminD->id,
                'daily_log_id' => $dailyLog->id,  // مهم جدًا
                'date' => $date,
                'pills_taken' => 1,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | TESTOSTERONE TEST
        |--------------------------------------------------------------------------
        */
        TestosteroneTest::create([
            'user_id' => $user->id,
            'total_testosterone' => 620,
            'free_testosterone' => 15.3,
            'date' => now()->subDays(10),
            'notes' => 'Good level',
        ]);
    }
}
