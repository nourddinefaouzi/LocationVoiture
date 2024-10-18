<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AccessoireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->word,
            'description' => $this->faker->sentence,
            'image' => 'acc.jpg',
            'quantite' => $this->faker->numberBetween(1, 10),
            'max' => $this->faker->numberBetween(1, 3),
            'prix' => $this->faker->numberBetween(20, 50),
            'prixType' => $this->faker->randomElement(['day', 'reservation'])
        ];
    }
}
