<?php

use App\Enums\TrainingSource;
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
       Schema::create('intent_trainings', function (Blueprint $table) {
    $table->id();
    $table->foreignId('intent_id')->constrained()->onDelete('cascade');
    $table->string('training_phrase');
    $table->boolean('is_positive')->default(true);
    $table->enum('source', array_column(TrainingSource::cases(), 'value'));
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intent_trainings');
    }
};
