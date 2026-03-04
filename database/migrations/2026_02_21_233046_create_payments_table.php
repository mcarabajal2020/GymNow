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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('gym_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('invoice_id')
                ->constrained()
                ->cascadeOnDelete();    

            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['cash', 'transfer', 'mp']);
            $table->date('payment_date');
            $table->enum('status', ['completed', 'void'])
                ->default('completed');

            $table->foreignId('voided_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('voided_at')->nullable();
            $table->string('external_payment_id')->nullable(); // futuro MercadoPago

            $table->timestamps();

            $table->index(['gym_id', 'member_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
