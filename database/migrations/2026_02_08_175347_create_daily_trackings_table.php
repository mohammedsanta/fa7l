<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyTrackingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('daily_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->string('type'); // sleep, water, workout, mood, quran, scrolling, etc.
            $table->json('data'); // لتخزين البيانات المختلفة لكل نوع
            $table->timestamps();

            $table->unique(['user_id', 'date', 'type']); // يمنع إدخال نفس النوع مرتين في اليوم
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_trackings');
    }
}
