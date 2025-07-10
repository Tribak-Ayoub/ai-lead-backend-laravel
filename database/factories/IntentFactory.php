<?php

namespace Database\Factories;

use App\Models\Intent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Intent>
 */
class IntentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Intent::class;

    public function definition()
    {
        $sources = ['ADMIN_DEFINED', 'AI_DISCOVERED', 'MANUAL_TRAINING', 'AUTO_LEARNED'];

        return [
            'name' => $this->faker->unique()->lexify('intent_??????'),
            'description' => $this->faker->sentence,
            'category' => $this->faker->word,
            'keywords' => $this->faker->words(5),
            'phrases' => $this->faker->sentences(3),
            'confidence_threshold' => $this->faker->randomFloat(2, 0.5, 0.95),
            'is_active' => true,
            'source' => $this->faker->randomElement($sources),
            'usage_count' => $this->faker->numberBetween(0, 100),
        ];
    }
}
