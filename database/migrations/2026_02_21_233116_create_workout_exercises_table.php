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
        Schema::create('workout_exercises', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('exercise_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->integer('series');
            $table->integer('repetitions');
            $table->decimal('suggested_weight', 6, 2)->nullable();
            $table->string('video_url')->nullable(); // override
            $table->integer('order_column')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_exercises');
    }
};
