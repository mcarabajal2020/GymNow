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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('dni');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->date('birth_date')->nullable();
            $table->enum('status', ['active','inactive','suspended'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index(['gym_id', 'dni']);
            $table->foreignId('plan_id')->constrained()->cascadeOnDelete();
                });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
