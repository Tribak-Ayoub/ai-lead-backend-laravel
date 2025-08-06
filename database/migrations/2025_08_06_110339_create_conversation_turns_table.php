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
        Schema::create('conversation_turns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('call_session_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('turn_number');
            $table->text('transcript');
            $table->foreignId('intent_id')->nullable()->constrained()->onDelete('set null');
            $table->float('confidence')->nullable();
            $table->text('ai_response')->nullable();
            $table->string('audio_file_path')->nullable();
            $table->boolean('is_user_message')->default(true);
            $table->boolean('needs_review')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversation_turns');
    }
};
