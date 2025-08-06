<?php

use App\Enums\CallStatus;
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
    $table->foreignId('lead_id')->constrained()->onDelete('cascade');
    $table->dateTime('start_time')->nullable();
    $table->dateTime('end_time')->nullable();
    $table->string('outcome')->nullable();
    $table->enum('status', array_column(CallStatus::cases(), 'value'))->default(CallStatus::SCHEDULED->value);
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
