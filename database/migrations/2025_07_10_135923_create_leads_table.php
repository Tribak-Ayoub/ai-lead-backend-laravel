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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->unique();
            $table->enum('status', ['NEW', 'CONTACTED', 'QUALIFIED', 'DISQUALIFIED', 'APPOINTMENT_SET', 'CLOSED'])
                ->default('NEW');
            $table->string('qualification')->nullable();
            $table->timestamp('last_call_at')->nullable();
            $table->unsignedInteger('call_attempts')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
