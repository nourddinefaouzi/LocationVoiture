<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MesReservationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $client = $user->client;

        $currentDate = Carbon::now();

        $reservations = Reservation::where('client_id', $client->id)
            ->where('statut', 'confirmed')
            ->get();

        //dd($reservations);
        $upcomingBookings = $reservations->filter(function ($reservation) use ($currentDate) {
            return Carbon::parse($reservation->debutReservation)->isAfter($currentDate);
        });

        $currentBookings = $reservations->filter(function ($reservation) use ($currentDate) {
            $startDate = Carbon::parse($reservation->debutReservation);
            $endDate = Carbon::parse($reservation->finReservation);
            return $startDate->lte($currentDate) && $endDate->gte($currentDate);
        });

        $pastBookings = $reservations->filter(function ($reservation) use ($currentDate) {
            return Carbon::parse($reservation->finReservation)->isBefore($currentDate);
        });

        return view('myres', compact('upcomingBookings', 'currentBookings', 'pastBookings'));
    }

    public function cancel($id){
        $reservation = Reservation::find($id);
        if ($reservation) {
            $reservation->statut = 'cancelled';
            $reservation->save();
        }
        return redirect()->route('myres');
    }

}
