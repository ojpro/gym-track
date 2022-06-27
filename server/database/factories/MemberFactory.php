<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'code' => $this->faker->numberBetween(1000, 9999),
            'card_id' => $this->faker->numberBetween(null,9000),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birthday' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['male', 'female', 'indeterminate', 'unknown']),
            'weight' => $this->faker->randomFloat(2,10,300),
            'height' => $this->faker->randomFloat(2,10,300),
            'address' => $this->faker->address(),
            'photo' => $this->faker->imageUrl,
            'phone' => $this->faker->e164PhoneNumber(),
            'username' => $this->faker->userName(),
            'email' => $this->faker->safeEmail(),
            'password' => Hash::make('password')
        ];
    }
}
