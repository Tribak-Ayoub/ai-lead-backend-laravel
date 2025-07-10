<?php

namespace Database\Factories;

use App\Models\Intent;
use App\Models\IntentTraining;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\IntentTraining>
 */
class IntentTrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = IntentTraining::class;

    public function definition()
    {
        $sources = ['ADMIN_MANUAL', 'CONVERSATION_REVIEW', 'FAILED_CLASSIFICATION', 'BULK_IMPORT'];

        return [
            'intent_id' => Intent::factory(),
            'training_phrase' => $this->faker->sentence,
            'is_positive' => $this->faker->boolean(80),
            'user_id' => User::factory(),
            'source' => $this->faker->randomElement($sources),
        ];
    }
}
