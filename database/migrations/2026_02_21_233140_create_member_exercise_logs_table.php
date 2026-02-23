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
        Schema::create('member_exercise_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('member_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('exercise_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->date('date');
            $table->decimal('weight', 6, 2)->nullable();
            $table->integer('repetitions')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['gym_id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_exercise_logs');
    }
};
