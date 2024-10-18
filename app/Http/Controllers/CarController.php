<?php

namespace App\Http\Controllers;

use App\Models\Accessoire;
use App\Models\Price;
use App\Models\Voiture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $dateDepart = Carbon::now()->addDays(1);
        $dateRetour = Carbon::now()->addDays(4);
        
        Session::put('dateDepart', $dateDepart);
        Session::put('dateRetour', $dateRetour);

        $pickUp = 'Marrakech';
        $dropOff= 'Marrakech';

        Session::put('pickUp', $pickUp);
        Session::put('dropOff', $dropOff);
        
        $resJours = $dateDepart->diffInDays($dateRetour);

        $currentDate = Carbon::now();
        
        $voitures = Voiture::where('statut', 'disponible') // Ensure car is available
            ->whereHas('prices', function ($query) use ($resJours, $dateDepart) {
                $query->where('minJoursReservation', '<=', $resJours)
                      ->where('maxJoursReservation', '>=', $resJours)
                      ->whereHas('saison', function ($query) use ($dateDepart) {
                          $query->where('debutSaison', '<=', $dateDepart)
                                ->where('finSaison', '>=', $dateDepart);
                      });
            })
            ->whereDoesntHave('reservations', function ($query) use ($dateDepart, $dateRetour) {
                // Avoid cars that are reserved during the given dates
                $query->where('statut', '=', 'confirmed')
                      ->where(function ($query) use ($dateDepart, $dateRetour) {
                          $query->where('debutReservation', '<=', $dateRetour)
                                ->where('finReservation', '>=', $dateDepart);
                      });
            })
            ->get();

        return view('cars.index', compact('voitures'));
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
    public function show(Request $request, $id)
    {
        $voiture = Voiture::find($id);
        Session::put('voitureID', $id);
                
        $price = $request->input('price');
        Session::put('price', $price);

        $accessoires = Accessoire::all();

        //$dureeReservation = session('dateDepart')->diffInDays(session('dateRetour'));
        $dureeReservation = Carbon::parse(session('dateDepart'))->diffInDays(Carbon::parse(session('dateRetour')));

        
        return view('cars.show', compact('voiture', 'price', 'accessoires', 'dureeReservation'));
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

    public function find(Request $request)
    {
        Session::put('dateDepart', $request->input('dateDepart'));
        Session::put('dateRetour', $request->input('dateRetour'));
        
        Session::put('pickUp', $request->input('pickUp'));
        Session::put('dropOff', $request->input('dropOff'));
        
        $pickUp = $request->input('pickUp');
        $dropOff = $request->input('dropOff');

        $dateDepart = Carbon::parse($request->input('dateDepart'));
        $dateRetour = Carbon::parse($request->input('dateRetour'));
        $resJours = $dateDepart->diffInDays($dateRetour);

        $currentDate = $dateDepart;
        
        $voitures = Voiture::where('statut', 'disponible') // Ensure car is available
            ->whereHas('prices', function ($query) use ($resJours, $dateDepart) {
                $query->where('minJoursReservation', '<=', $resJours)
                      ->where('maxJoursReservation', '>=', $resJours)
                      ->whereHas('saison', function ($query) use ($dateDepart) {
                          $query->where('debutSaison', '<=', $dateDepart)
                                ->where('finSaison', '>=', $dateDepart);
                      });
            })
            ->whereDoesntHave('reservations', function ($query) use ($dateDepart, $dateRetour) {
                // Avoid cars that are reserved during the given dates
                $query->where('statut', '=', 'confirmed')
                      ->where(function ($query) use ($dateDepart, $dateRetour) {
                          $query->where('debutReservation', '<=', $dateRetour)
                                ->where('finReservation', '>=', $dateDepart);
                      });
            })
            ->get();

        //dd($voitures);

        return view('cars.index', compact('voitures', 'dateDepart', 'dateRetour'));
    }

    public function payment(Request $request)
    {
        $dateDepart = session('dateDepart');
        $dateRetour = session('dateRetour');
        $pickUp = session('pickUp');
        $dropOff = session('dropOff');
        //$secondDriver = ;
        $voiture_id = session('voitureID');
        $price = session('price');
        $client_id = session('client_id');
        $total_price = $request->input('total_price');
        $accessoires_selection = json_decode($request->input('accessoires_selection'), true);
        $second_driver_info = json_decode($request->input('second_driver_info'), true);

        return view('payment', compact('voiture_id', 'price', 'client_id', 'dateDepart', 'dateRetour', 'pickUp', 'dropOff', 'total_price', 'accessoires_selection', 'second_driver_info'));
    }
}
