<?php

namespace Database\Factories;

use App\Models\CallSession;
use App\Models\ConversationSummary;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConversationSummary>
 */
class ConversationSummaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ConversationSummary::class;

    public function definition()
    {
        return [
            'call_session_id' => CallSession::factory(),
            'key_intents' => $this->faker->words(3),
            'final_response' => $this->faker->sentence,
            'qualification_notes' => $this->faker->paragraph,
            'overall_sentiment' => $this->faker->randomFloat(2, -1, 1),
        ];
    }
}
