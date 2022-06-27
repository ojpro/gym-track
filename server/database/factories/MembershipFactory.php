<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'attendances' => $this->faker->numberBetween(1, 30),
            'price' => $this->faker->numberBetween(1, 1000),
            'notes' => $this->faker->sentence()
        ];
    }
}
