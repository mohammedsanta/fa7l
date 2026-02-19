<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplementPlanItemsTable extends Migration
{
    public function up(): void
    {
        Schema::create('supplement_plan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplement_plan_id')->constrained()->cascadeOnDelete();
            $table->foreignId('supplement_id')->constrained()->cascadeOnDelete();
            $table->integer('pills_per_day')->default(1);
            $table->float('price')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplement_plan_items');
    }
}
