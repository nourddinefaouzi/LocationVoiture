<?php

namespace Database\Factories;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChargeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween('-2 month', 'now');
        return [
            'montant' => $this->faker->numberBetween(100, 1000),
            'date' => $date,
            'motif' => $this->faker->word(),
            'voiture_id' => Voiture::all()->random()->id
        ];
    }
}
