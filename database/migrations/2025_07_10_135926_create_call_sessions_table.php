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
        Schema::create('call_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->string('outcome')->nullable();
            $table->string('audio_file_path')->nullable();
            $table->enum('status', [
                'SCHEDULED',
                'DIALING',
                'RINGING',
                'ANSWERED',
                'BUSY',
                'NO_ANSWER',
                'FAILED',
                'COMPLETED'
            ])->default('SCHEDULED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_sessions');
    }
};
