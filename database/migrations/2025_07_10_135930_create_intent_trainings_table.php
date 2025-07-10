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
        Schema::create('intent_trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intent_id')->constrained()->cascadeOnDelete();
            $table->text('training_phrase');
            $table->boolean('is_positive')->default(true);
            $table->enum('source', ['ADMIN_MANUAL', 'CONVERSATION_REVIEW', 'FAILED_CLASSIFICATION', 'BULK_IMPORT'])
                ->default('ADMIN_MANUAL');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intent_trainings');
    }
};
