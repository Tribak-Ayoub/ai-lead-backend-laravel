<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique(); // ✅ تمت إضافة هذا السطر
            $table->string('phone_number');
            $table->enum('status', [
                'NEW',
                'CONTACTED',
                'QUALIFIED',
                'DISQUALIFIED',
                'APPOINTMENT_SET',
                'CLOSED'
            ])->default('NEW');
            $table->string('qualification')->nullable();
            $table->dateTime('last_call_at')->nullable();
            $table->unsignedInteger('call_attempts')->default(0);
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
