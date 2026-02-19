<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPreferencesTable extends Migration
{
    public function up(): void
    {
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->boolean('track_sleep')->default(false);
            $table->boolean('track_water')->default(false);
            $table->boolean('track_workout')->default(false);
            $table->boolean('track_mood')->default(false);
            $table->boolean('track_quran')->default(false);
            $table->boolean('track_scrolling')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
}
