<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('daily_workouts', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('daily_log_id')->constrained()->cascadeOnDelete();
    $table->foreignId('workout_id')->constrained()->cascadeOnDelete();
    $table->integer('duration_minutes')->nullable();
    $table->enum('intensity', ['low', 'medium', 'high'])->nullable();
    $table->string('date');
    $table->string('duration');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_workouts');
    }
};
