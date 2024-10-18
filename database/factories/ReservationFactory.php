<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Price;
use App\Models\Voiture;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $debutReservation = $this->faker->dateTimeBetween('-1 month', 'now');
        $finReservation = $this->faker->dateTimeBetween($debutReservation, '+1 week');

        return [
            'debutReservation' => $debutReservation,
            'finReservation' => $finReservation,
            'statut' => $this->faker->randomElement(['confirmed', 'pending', 'cancelled']),
            'client_id' => Client::inRandomOrder()->first()->id,
            'voiture_id' => Voiture::inRandomOrder()->first()->id,
            'secondDriver' => $this->faker->randomElement([Client::inRandomOrder()->first()->id, null]),
            'codeContrat' => $this->faker->uuid(),
            'prixVoiture' => $this->faker->numberBetween(100, 200),
            'pickUp' => $this->faker->city(),
            'dropOff' => $this->faker->city(),
            'total' => $this->faker->numberBetween(200, 300)
        ];
    }
}
