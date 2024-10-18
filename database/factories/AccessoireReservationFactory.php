<?php

namespace Database\Factories;

use App\Models\Accessoire;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessoireReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'quantite' => $this->faker->numberBetween(1, 3),
            'accessoire_id' => Accessoire::all()->random()->id,
            'reservation_id' =>Reservation::all()->random()->id
        ];
    }
}
