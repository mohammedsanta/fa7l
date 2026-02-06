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
Schema::create('supplement_vitamins', function (Blueprint $table) {
    $table->id();
    $table->foreignId('supplement_id')->constrained()->cascadeOnDelete();
    $table->foreignId('vitamin_id')->constrained()->cascadeOnDelete();
    $table->float('amount_per_pill');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplement_vitamins');
    }
};
