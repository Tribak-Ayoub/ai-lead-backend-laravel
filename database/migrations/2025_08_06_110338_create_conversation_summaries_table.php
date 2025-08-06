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
        Schema::create('conversation_summaries', function (Blueprint $table) {
    $table->id();
    $table->foreignId('call_session_id')->constrained()->onDelete('cascade');
    $table->json('key_intents')->nullable();
    $table->text('final_response')->nullable();
    $table->text('qualification_notes')->nullable();
    $table->float('overall_sentiment')->default(0.0);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_summaries');
    }
};
