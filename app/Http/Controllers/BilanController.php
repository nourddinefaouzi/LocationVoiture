<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all charges and reservations
        $charges = Charge::all();
        $reservations = Reservation::where('statut', 'confirmed')->get();

        // Merge charges and reservations into one collection
        $bilan = collect();

        // Add charges with 'type' => 'charge' for later identification
        foreach ($charges as $charge) {
            $bilan->push([
                'date' => Carbon::parse($charge->date), // Parse date as Carbon instance
                'description' => $charge->motif,
                'montant' => -$charge->montant, // Charges are negative
                'type' => 'charge',
            ]);
        }

        // Add reservations with 'type' => 'reservation'
        foreach ($reservations as $reservation) {
            $bilan->push([
                'date' => Carbon::parse($reservation->debutReservation),
                'description' => 'Reservation de la voiture ID: ' . $reservation->voiture_id,
                'montant' => $reservation->total,
                'type' => 'reservation',
            ]);
        }

        // Sort by date (new to old)
        $bilan = $bilan->sortByDesc('date');

        // Pass the sorted data to the view
        return view('bilan.index', compact('bilan'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get all charges and reservations
        $charges = Charge::where('voiture_id', $id)->get();
        $reservations = Reservation::where('voiture_id', $id)->where('statut', 'confirmed')->get();

        // Merge charges and reservations into one collection
        $bilan = collect();

        // Add charges with 'type' => 'charge' for later identification
        foreach ($charges as $charge) {
            $bilan->push([
                'date' => Carbon::parse($charge->date), // Parse date as Carbon instance
                'description' => $charge->motif,
                'montant' => -$charge->montant, // Charges are negative
                'type' => 'charge',
            ]);
        }

        // Add reservations with 'type' => 'reservation'
        foreach ($reservations as $reservation) {
            $bilan->push([
                'date' => Carbon::parse($reservation->debutReservation),
                'description' => 'Reservation de la voiture',
                'montant' => $reservation->total,
                'type' => 'reservation',
            ]);
        }

        // Sort by date (new to old)
        $bilan = $bilan->sortByDesc('date');

        // Pass the sorted data to the view
        return view('bilan.index', compact('bilan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
