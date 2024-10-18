<?php

namespace Database\Factories;

use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaisonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->text(10),
            'debutSaison' => $this->faker->date(),
            'finSaison' => $this->faker->date(),
        ];
    }
}
