<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Lead::class;

    public function definition(): array
    {
        $statuses = ['NEW', 'CONTACTED', 'QUALIFIED', 'DISQUALIFIED', 'APPOINTMENT_SET', 'CLOSED'];

        return [
            'name' => $this->faker->name,
            'phone_number' => $this->faker->phoneNumber,
            'status' => $this->faker->randomElement($statuses),
            'qualification' => $this->faker->sentence,
            'last_call_at' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'call_attempts' => $this->faker->numberBetween(0, 5),
        ];
    }
}
