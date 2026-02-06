<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnalyticsController;

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
    | DAILY LOG
    |--------------------------------------------------------------------------
    */
    Route::post('/daily-log', [DailyLogController::class, 'store']);
    Route::put('/daily-log/{date}', [DailyLogController::class, 'update']);
    Route::get('/daily-log/{date}', [DailyLogController::class, 'show']);

    /*
    |--------------------------------------------------------------------------
    | DAILY EXERCISE CHECK (Rest vs Lazy)
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
