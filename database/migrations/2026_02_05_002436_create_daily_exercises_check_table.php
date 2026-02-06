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
Schema::create('daily_exercises_check', function (Blueprint $table) {
    $table->id();
    $table->foreignId('daily_log_id')->constrained()->cascadeOnDelete();

    $table->boolean('did_exercise')->default(false);
    $table->boolean('did_face_exercise')->default(false);
    $table->boolean('did_body_exercise')->default(false);

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_exercises_check');
    }
};
