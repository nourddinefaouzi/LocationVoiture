<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Tel' => $this->faker->phoneNumber,
            'Permis' => $this->faker->randomNumber(8),
            'Adresse' => $this->faker->address,
            'cin' => $this->faker->iban(),
            'passport' => $this->faker->iban(),
            'user_id' => User::where('role','client')->inRandomOrder()->first()->id
        ];
    }
}
