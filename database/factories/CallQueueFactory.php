<?php

namespace Database\Factories;

use App\Models\CallQueue;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CallQueue>
 */
class CallQueueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = CallQueue::class;

    public function definition()
    {
        $priorities = ['LOW', 'MEDIUM', 'HIGH', 'URGENT'];
        $statuses = ['PENDING', 'PROCESSING', 'COMPLETED', 'FAILED', 'CANCELLED'];

        return [
            'lead_id' => Lead::factory(),
            'priority' => $this->faker->randomElement($priorities),
            'scheduled_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'status' => $this->faker->randomElement($statuses),
            'retry_count' => $this->faker->numberBetween(0, 3),
            'max_retries' => 3,
        ];
    }
}
