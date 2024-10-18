<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Price;
use App\Models\Saison;
use App\Models\Voiture;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voitures = Voiture::all();
        return view('voitures.index', compact('voitures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saisons = Saison::all();
        return view('voitures.create', compact('saisons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $dateVoiture = $request->validate([
            'marque' => 'required',
            'modele' => 'required',
            'couleur' => 'required',
            'immatriculation' => 'required',
            'carburant' => 'required',
            'puissance' => 'required',
            'kilometrage' => 'required',
            'statut' => 'required',
            'prices' => 'array',
            'images.*' => 'required'
        ]);

        $voiture = Voiture::create($dateVoiture);

        $voiture_id = $voiture->id;
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('photos', 'public');
    
                Photo::create([
                    'path' => $path,
                    'voiture_id' => $voiture_id
                ]);
            }
        }

        if(isset($request->prices)){
            foreach ($request->prices as $priceData) {
                Price::create([
                    'voiture_id' => $voiture_id,
                    'saison_id' => $priceData['saison_id'],
                    'minJoursReservation' => $priceData['minJoursReservation'],
                    'maxJoursReservation' => $priceData['maxJoursReservation'],
                    'prix' => $priceData['prix'],
                ]);
            }
        }

        //return back()->with('success', 'Article ajouté avec succès');
        return redirect()->route('voitures.index')->with('success', 'Article ajouter avec succes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voiture = Voiture::find($id);
        return view('voitures.show', compact('voiture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voiture = Voiture::find($id);
        $saisons = Saison::all();
        return view('voitures.edit', compact('voiture', 'saisons'));
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
        $data = $request->validate([
            'marque' => 'required',
            'modele' => 'required',
            'couleur' => 'required',
            'immatriculation' => 'required',
            'carburant' => 'required',
            'puissance' => 'required',
            'kilometrage' => 'required',
            'statut' => 'required'
        ]);

        Voiture::find($id)->update($data);

        //dd($request);
        if(isset($request->prices)){
            foreach ($request->prices as $priceData) {
                if ($priceData['id'] == 0){
                    Price::create([
                        'voiture_id' => $id,
                        'saison_id' => $priceData['saison_id'],
                        'minJoursReservation' => $priceData['minJoursReservation'],
                        'maxJoursReservation' => $priceData['maxJoursReservation'],
                        'prix' => $priceData['prix'],
                    ]);
                }else
                {
                    $price = Price::find($priceData['id']);
                    if ($price) {
                        $price->update([
                            'voiture_id' => $id,
                            'saison_id' => $priceData['saison_id'],
                            'minJoursReservation' => $priceData['minJoursReservation'],
                            'maxJoursReservation' => $priceData['maxJoursReservation'],
                            'prix' => $priceData['prix'],
                        ]);
                    }
                }
            }
        }

        //return back()->with('success', 'Article modifie avec succès');
        return redirect()->route('voitures.index')->with('success', 'Article modifie avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Voiture::find($id)->delete();

        return redirect()->route('voitures.index')->with('danger', 'Article supprimer avec succes');
    }

    public function search(){
        return view('voitures.search');
    }

    public function find(Request $request)
    {
        $dateDepart = Carbon::parse($request->input('dateDepart'));
        $dateRetour = Carbon::parse($request->input('dateRetour'));
        $resJours = $dateDepart->diffInDays($dateRetour);

        $currentDate = Carbon::now();
        
        $voitures = Voiture::whereHas('prices', function ($query) use ($resJours, $currentDate) {
            $query->where('minJoursReservation', '<=', $resJours)
                  ->where('maxJoursReservation', '>=', $resJours)
                  ->whereHas('saison', function ($query) use ($currentDate) {
                      $query->where('debutSaison', '<=', $currentDate)
                            ->where('finSaison', '>=', $currentDate);
                  });
        })
        ->whereDoesntHave('prices.reservations', function ($query) use ($dateDepart, $dateRetour) {
            $query->where('statut', '=', 'confirmed')  
                  ->where(function ($query) use ($dateDepart, $dateRetour) {
                      $query->where(function ($subquery) use ($dateDepart, $dateRetour) {
                          $subquery->where('debutReservation', '<=', $dateRetour)
                                   ->where('finReservation', '>=', $dateDepart);
                      });
                  });
        })->get();

        //dd($voitures);

        return view('voitures.result', compact('voitures', 'dateDepart', 'dateRetour'));
    }
}
