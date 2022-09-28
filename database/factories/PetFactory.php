<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'client_id' => $this->faker->randomElement([1, 2, 3, 4]),
            // 'breed_id' => $this->faker->numberBetween(3, 17),
            'name' => $this->faker->firstName(),
            'date_of_birth' => $this->faker->dateTimeThisDecade(),
            'gender' => $this->faker->randomElement(['male', 'female']),
        ];
    }
}
