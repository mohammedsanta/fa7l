<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserPreferenceController;

use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\DailyExerciseCheckController;

use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\DailyWorkoutController;

use App\Http\Controllers\FoodController;
use App\Http\Controllers\DailyFoodController;

use App\Http\Controllers\SupplementController;
use App\Http\Controllers\DailySupplementController;

use App\Http\Controllers\TestosteroneTestController;

use App\Http\Controllers\SupplementPlanController;
use App\Http\Controllers\SupplementPlanItemController;

use App\Http\Controllers\VitaminAnalyticsController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\TrackingController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });

});

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */
    Route::get('/user/profile', [UserController::class, 'show']);
    Route::put('/user/profile', [UserController::class, 'update']);

    /*
    |--------------------------------------------------------------------------
    | USER TRACKING PREFERENCES (NEW)
    |--------------------------------------------------------------------------
    */
    Route::get('/user/tracking-options', [UserPreferenceController::class, 'index']);
    Route::post('/user/tracking-options', [UserPreferenceController::class, 'store']);

    /*
    |--------------------------------------------------------------------------
    | DAILY LOG (CORE DAY STATUS)
    |--------------------------------------------------------------------------
    */
    Route::post('/daily-log', [DailyLogController::class, 'store']);
    Route::put('/daily-log/{date}', [DailyLogController::class, 'update']);
    Route::get('/daily-log/{date}', [DailyLogController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | DAILY EXERCISE CHECK (REST vs LAZY)
    |--------------------------------------------------------------------------
    */
    Route::post('/daily-exercise-check', [DailyExerciseCheckController::class, 'store']);
    Route::get('/daily-exercise-check/{date}', [DailyExerciseCheckController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | WORKOUTS
    |--------------------------------------------------------------------------
    */
    Route::get('/workouts', [WorkoutController::class, 'index']);
    Route::post('/workouts', [WorkoutController::class, 'store']); // admin later

    Route::post('/daily-workouts', [DailyWorkoutController::class, 'store']);
    Route::get('/daily-workouts/{date}', [DailyWorkoutController::class, 'index']);
    Route::delete('/daily-workouts/{id}', [DailyWorkoutController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | FOODS
    |--------------------------------------------------------------------------
    */
    Route::get('/foods', [FoodController::class, 'index']);
    Route::post('/foods', [FoodController::class, 'store']); // admin

    Route::post('/daily-foods', [DailyFoodController::class, 'store']);
    Route::get('/daily-foods/{date}', [DailyFoodController::class, 'index']);
    Route::delete('/daily-foods/{id}', [DailyFoodController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | SUPPLEMENTS
    |--------------------------------------------------------------------------
    */
    Route::get('/supplements', [SupplementController::class, 'index']);
    Route::post('/supplements', [SupplementController::class, 'store']); // admin

    Route::post('/daily-supplements', [DailySupplementController::class, 'store']);
    Route::get('/daily-supplements/{date}', [DailySupplementController::class, 'index']);

    /*
    |--------------------------------------------------------------------------
    | TESTOSTERONE TESTS
    |--------------------------------------------------------------------------
    */
    Route::post('/testosterone-tests', [TestosteroneTestController::class, 'store']);
    Route::get('/testosterone-tests', [TestosteroneTestController::class, 'index']);
    Route::get('/testosterone-tests/{id}', [TestosteroneTestController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | SUPPLEMENT MONTHLY PLAN
    |--------------------------------------------------------------------------
    */
    Route::post('/supplement-plans', [SupplementPlanController::class, 'store']);
    Route::get('/supplement-plans/{month}/{year}', [SupplementPlanController::class, 'show']);

    Route::post('/supplement-plan-items', [SupplementPlanItemController::class, 'store']);
    Route::delete('/supplement-plan-items/{id}', [SupplementPlanItemController::class, 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | DAILY TRACKING (NEW – MODULAR)
    |--------------------------------------------------------------------------
    */
    Route::prefix('tracking')->group(function () {

        Route::post('/sleep', [TrackingController::class, 'sleep']);
        Route::post('/water', [TrackingController::class, 'water']);
        Route::post('/mood', [TrackingController::class, 'mood']);
        Route::post('/reading', [TrackingController::class, 'reading']);
        Route::post('/meditation', [TrackingController::class, 'meditation']);

        Route::post('/steps', [TrackingController::class, 'steps']);
        Route::post('/weight', [TrackingController::class, 'weight']);

        Route::post('/work-hours', [TrackingController::class, 'workHours']);
        Route::post('/study', [TrackingController::class, 'study']);

        Route::post('/expenses', [TrackingController::class, 'expenses']);

        Route::post('/quran', [TrackingController::class, 'quran']); // NEW
        Route::post('/scrolling', [TrackingController::class, 'scrolling']); // NEW

        Route::post('/face-exercise', [TrackingController::class, 'faceExercise']);
        Route::post('/achievement', [TrackingController::class, 'achievement']);

        Route::get('/today', [TrackingController::class, 'todayStatus']);
        Route::get('/weekly-summary', [TrackingController::class, 'weeklySummary']);
    });

    /*
    |--------------------------------------------------------------------------
    | VITAMIN ANALYTICS
    |--------------------------------------------------------------------------
    */
    Route::get('/vitamins/weekly-report', [VitaminAnalyticsController::class, 'weeklyReport']);

    /*
    |--------------------------------------------------------------------------
    | SMART ANALYTICS
    |--------------------------------------------------------------------------
    */
    Route::get('/analytics/testosterone-score', [AnalyticsController::class, 'testosteroneScore']);
    Route::get('/analytics/rest-lazy-evaluation', [AnalyticsController::class, 'restLazyEvaluation']);

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard/summary', [DashboardController::class, 'summary']);
    Route::get('/dashboard/weekly-performance', [DashboardController::class, 'weekly']);
    Route::get('/dashboard/monthly-progress', [DashboardController::class, 'monthly']);

});
