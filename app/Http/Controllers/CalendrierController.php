<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendrierController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['client.user', 'voiture'])
            ->where('statut', 'confirmed')
            ->get()
            ->map(function ($reservation) {
                return [
                    'title' => "client: " . $reservation->client->user->name . " - voiture: " . $reservation->voiture->marque . " " . $reservation->voiture->modele, 
                    'start' => $reservation->debutReservation->format('Y-m-d'),
                    'end' => $reservation->finReservation->format('Y-m-d'),
                    //'allDay' => true, // Specify that this is an all-day event
                ];
            });

        return view('calendrier.index', compact('reservations'));
    }


    
}
                                                                                                                                                                                                 