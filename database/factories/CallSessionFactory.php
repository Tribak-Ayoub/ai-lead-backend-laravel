<?php

namespace Database\Factories;

use App\Models\CallSession;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CallSession>
 */
class CallSessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CallSession::class;

    public function definition()
    {
        $statuses = ['SCHEDULED', 'DIALING', 'RINGING', 'ANSWERED', 'BUSY', 'NO_ANSWER', 'FAILED', 'COMPLETED'];

        $start = $this->faker->dateTimeBetween('-1 week', 'now');
        $end = (clone $start)->modify('+'.rand(1,30).' minutes');

        return [
            'lead_id' => Lead::factory(),
            'start_time' => $start,
            'end_time' => $end,
            'outcome' => $this->faker->sentence,
            'audio_file_path' => $this->faker->optional()->filePath(),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
