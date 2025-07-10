<?php

namespace Database\Factories;

use App\Models\CallSession;
use App\Models\ConversationTurn;
use App\Models\Intent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ConversationTurn>
 */
class ConversationTurnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ConversationTurn::class;

    public function definition()
    {
        return [
            'call_session_id' => CallSession::factory(),
            'turn_number' => $this->faker->numberBetween(1, 20),
            'transcript' => $this->faker->sentence,
            'detected_intent_id' => Intent::factory(),
            'confidence' => $this->faker->randomFloat(2, 0.5, 1),
            'ai_response' => $this->faker->sentence,
            'is_user_message' => $this->faker->boolean(80), // 80% chance true
            'needs_review' => $this->faker->boolean(10),    // 10% chance true
        ];
    }
}
