<?php

namespace App\Http\Controllers;

use App\Models\Accessoire;
use App\Models\AccessoireReservation;
use App\Models\Client;
use App\Models\Price;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Voiture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{

    public function __construct()
    {
        $this->middleware('adminAuth')->except('store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $clients = Client::all();
        $accessoires = Accessoire::all();
    
        $dateDepart = Carbon::parse($request->query('dateDepart', Carbon::now()->addDay()->toDateString()));
        $dateRetour = Carbon::parse($request->query('dateRetour', Carbon::now()->addDays(4)->toDateString()));
    
        Session::put('dateDepart', $dateDepart);
        Session::put('dateRetour', $dateRetour);
    
        $resJours = Carbon::parse($dateDepart)->diffInDays(Carbon::parse($dateRetour));
        $currentDate = Carbon::now();
    
        // Query to get voitures with 'disponible' status and appropriate pricing
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
    
        return view('reservations.create', compact('clients', 'voitures', 'accessoires'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        // Validate request data
        $data = $request->validate([
            'debutReservation' => 'required|date',
            'finReservation' => 'required|date',
            'pickUp' => 'required|string|max:255',
            'dropOff' => 'required|string|max:255',
            'statut' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'secondDriver' => 'nullable|json',
            'codeContrat' => 'required|string|max:255',
            'voiture_id' => 'required|exists:voitures,id',
            'prixVoiture' => 'required|numeric',
            'total' => 'required|numeric',
            'accessoires_selection' => 'nullable|json'
        ]);
    
        if ($request->has('accessoires_selection')) {
            $secondDriverData = json_decode($request->input('secondDriver'), true);
            if (empty($secondDriverData)) {
                $data['secondDriver'] = null;
            }
            else {
        
                $userData = [
                    'name' => $secondDriverData['name'],
                    'email' => $secondDriverData['email'],
                    'password' => Hash::make('password'), // Consider generating a random password
                    'role' => 'client',
                ];
        
                $user = User::create($userData);
        
                $clientData = [
                    'Tel' => $secondDriverData['tel'],
                    'Permis' => $secondDriverData['permis'],
                    'Adresse' => $secondDriverData['adresse'],
                    'cin' => $secondDriverData['cin'],
                    'passport' => $secondDriverData['passport'],
                ];
        
                $client = $user->client()->create($clientData);
        
                $data['secondDriver'] = $client->id;
            }
        }
    
        $reservation = Reservation::create($data);
    
        if ($request->has('accessoiresData')) 
            $accessoiresSelection = json_decode($request->input('accessoiresData'), true);
        
        if ($request->has('accessoires_selection')) 
            $accessoiresSelection = json_decode($request->input('accessoires_selection'), true);
    
        if (is_array($accessoiresSelection) && !empty($accessoiresSelection)) {
            foreach ($accessoiresSelection as $accessoire) {
                AccessoireReservation::create([
                    'quantite' => $accessoire['quantity'],
                    'accessoire_id' => $accessoire['id'],
                    'reservation_id' => $reservation->id,
                ]);
            }
        }

        if ($request->has('accessoires_selection')) 
            return redirect()->route('cars.index')->with('success', 'Réservation ajoutée avec succès');

        return redirect()->route('reservations.index')->with('success', 'Réservation ajoutée avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::find($id);
        $secondDriver = Client::find($reservation->secondDriver);
        $accessoires = $reservation->accessoires()->get();
                
        return view('reservations.show', compact('reservation', 'secondDriver', 'accessoires'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $clients = Client::all();
        $accessoires = Accessoire::all();
    
        $dateDepart = Carbon::parse($request->query('dateDepart', Carbon::now()->addDay()->toDateString()));
        $dateRetour = Carbon::parse($request->query('dateRetour', Carbon::now()->addDays(4)->toDateString()));
    
        Session::put('dateDepart', $dateDepart);
        Session::put('dateRetour', $dateRetour);
    
        $resJours = Carbon::parse($dateDepart)->diffInDays(Carbon::parse($dateRetour));
        $currentDate = Carbon::now();
    
        // Query to get voitures with 'disponible' status and appropriate pricing
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

        // Fetch the voiture in the reservation
        $reservationVoiturePrice = Reservation::with(['voiture.prices'])->findOrFail($id);
        $reservedVoiture = $reservationVoiturePrice->voiture;
        
        // Add the reserved voiture to the collection if it's not already available
        if ($reservedVoiture && !$voitures->contains($reservedVoiture)) {
            $voitures->prepend($reservedVoiture);
        }
        // Fetch the reservation by ID
        $reservation = Reservation::with('accessoires')->findOrFail($id);

        // Return the edit view with the reservation data
        return view('reservations.edit', compact('reservation', 'clients', 'voitures', 'accessoires'));
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
        // Validate request data
        $data = $request->validate([
            'debutReservation' => 'required|date',
            'finReservation' => 'required|date',
            'pickUp' => 'required|string|max:255',
            'dropOff' => 'required|string|max:255',
            'statut' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'secondDriver' => 'nullable|exists:clients,id',  // Optional if second driver can be nullable
            'codeContrat' => 'required|string|max:255',
            'voiture_id' => 'required|exists:voitures,id',
            'total' => 'required|numeric',
            'prixVoiture' => 'required|numeric',  // Assuming you store the voiture price in the 'total' price
            'accessoiresData' => 'nullable|string'
        ]);
    
        // Find the reservation by ID
        $reservation = Reservation::findOrFail($id);
    
        // Update reservation fields except 'prixVoiture' and 'accessoiresData'
        $reservation->update([
            'debutReservation' => $data['debutReservation'],
            'finReservation' => $data['finReservation'],
            'pickUp' => $data['pickUp'],
            'dropOff' => $data['dropOff'],
            'statut' => $data['statut'],
            'client_id' => $data['client_id'],
            'secondDriver' => $data['secondDriver'], // Assuming it's nullable
            'codeContrat' => $data['codeContrat'],
            'voiture_id' => $data['voiture_id'],
            'total' => $data['total'],  // The total includes the price of the voiture and accessories
        ]);

        //dd($request->accessoiresData);
    
        // Handle updating of accessories
        if ($request->has('accessoiresData')) {
            $accessoiresData = json_decode($request->accessoiresData, true);
            $reservation->accessoires()->detach(); // Remove existing accessories
        
            
            // Attach new accessories with their quantities
            foreach ($accessoiresData as $accessoireData) {
                $reservation->accessoires()->attach($accessoireData['id'], [
                    'quantite' => $accessoireData['quantity']
                ]);
            }
        }
    
        // Save the updated reservation (no need to call save() as update() already does it)
        return redirect()->route('reservations.index')->with('success', 'Reservation updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reservation::find($id)->delete();

        return redirect()->route('reservations.index')->with('danger', 'reservation supprimer avec succes');

    }

    public function result(Request $request)
    {
        $dateDepart = $request->input('dateDepart');
        $dateRetour = $request->input('dateRetour');
        
        $voiture = Voiture::findOrFail($request->input('voiture_id'));
        $price = Price::findOrFail($request->input('price_id'));
        
        return view('reservations.result', compact('voiture', 'price', 'dateDepart', 'dateRetour'));
    }
}
