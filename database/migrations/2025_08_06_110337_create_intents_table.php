<?php

use App\Enums\IntentSource;
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
            $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('category')->nullable();
            $table->json('keywords')->nullable();
            $table->json('phrases')->nullable();
            $table->float('confidence_threshold')->default(0.7);
            $table->boolean('is_active')->default(true);
            $table->enum('source', array_column(IntentSource::cases(), 'value'));
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
