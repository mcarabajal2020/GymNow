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
        Schema::create('member_workouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('member_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('workout_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->date('start_date');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->index(['gym_id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_workouts');
    }
};
