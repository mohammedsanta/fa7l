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
Schema::create('food_vitamins', function (Blueprint $table) {
    $table->id();
    $table->foreignId('food_id')->constrained()->cascadeOnDelete();
    $table->foreignId('vitamin_id')->constrained()->cascadeOnDelete();
    $table->float('amount');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_vitamins');
    }
};
