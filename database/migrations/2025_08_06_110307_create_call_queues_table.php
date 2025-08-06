<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\QueueStatus;
use App\Enums\Priority;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('call_queues', function (Blueprint $table) {
    $table->id();
    $table->foreignId('lead_id')->constrained()->onDelete('cascade');
    $table->enum('priority', array_column(Priority::cases(), 'value'))->default(Priority::MEDIUM->value);
    $table->dateTime('scheduled_time');
    $table->enum('status', array_column(QueueStatus::cases(), 'value'))->default(QueueStatus::PENDING->value);
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
