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
        Schema::create('intents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('category')->nullable();
            $table->json('keywords')->nullable();   // string[]
            $table->json('phrases')->nullable();    // string[]
            $table->decimal('confidence_threshold', 3, 2)->default(0.80);
            $table->boolean('is_active')->default(true);
            $table->enum('source', ['ADMIN_DEFINED', 'AI_DISCOVERED', 'MANUAL_TRAINING', 'AUTO_LEARNED'])
                ->default('ADMIN_DEFINED');
            $table->unsignedInteger('usage_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intents');
    }
};
