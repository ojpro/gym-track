<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $random_date = $this->faker->dateTime();
        return [
            'status' => $this->faker->randomElement(['current', 'pending', 'canceled', 'expired']),
            'number' => $this->faker->numberBetween(1, 12),
            'started_at' => Carbon::create($random_date)->toDateTimeString(),
            'expire_at' => Carbon::create($random_date)
                ->addMonths($this->faker->numberBetween(1, 12))
                ->toDateTimeString()
        ];
    }
}
