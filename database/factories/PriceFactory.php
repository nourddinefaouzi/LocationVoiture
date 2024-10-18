<?php

namespace Database\Factories;

use App\Models\Saison;
use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'minJoursReservation' => $this->faker->numberBetween(1, 7),
            'maxJoursReservation' => $this->faker->numberBetween(8, 60),
            'prix' => $this->faker->numberBetween(20, 150),
            'voiture_id' => Voiture::all()->random()->id,
            'saison_id' => Saison::all()->random()->id
        ];
    }
}
