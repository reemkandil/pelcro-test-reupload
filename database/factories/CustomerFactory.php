<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title($gender = null|'male'|'female'),
            'first_name' => $this->faker->firstName($gender = null|'male'|'female'),
            'last_name' => $this->faker->lastName(),
            'company' => $this->faker->company(),
            'email' => $this->faker->companyEmail(),
            'username' => $this->faker->userName(),
            'salary' => $this->faker->randomNumber($nbDigits = NULL, $strict = false),
            'status' => $this->faker->boolean($chanceOfGettingTrue = 50),
        ];
    }
}
