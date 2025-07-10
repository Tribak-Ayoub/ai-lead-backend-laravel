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
        Schema::create('call_queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->cascadeOnDelete();
            $table->enum('priority', ['LOW', 'MEDIUM', 'HIGH', 'URGENT'])->default('MEDIUM');
            $table->dateTime('scheduled_time')->nullable();
            $table->enum('status', ['PENDING', 'PROCESSING', 'COMPLETED', 'FAILED', 'CANCELLED'])
                ->default('PENDING');
            $table->unsignedInteger('retry_count')->default(0);
            $table->unsignedInteger('max_retries')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_queues');
    }
};
