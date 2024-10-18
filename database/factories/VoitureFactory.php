<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VoitureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'marque' => $this->faker->word(),
            'modele'=> $this->faker->word(),
            'couleur' => $this->faker->colorName(),
            'immatriculation' => $this->faker->uuid(),
            'carburant' => $this->faker->word(),
            'puissance' => $this->faker->numberBetween(100, 1000),
            'kilometrage' => $this->faker->numberBetween(30000, 100000),
            'statut' => $this->faker->randomElement(['disponible', 'non disponible'])
        ];
    }
}
