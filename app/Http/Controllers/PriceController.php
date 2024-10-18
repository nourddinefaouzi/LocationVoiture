<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Saison;
use App\Models\Voiture;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prices = Price::all();
        return view('prices.index', compact('prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $saisons = Saison::all();
        $voitures = Voiture::all();
        return view('prices.create', compact('voitures', 'saisons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'minJoursReservation' => 'required',
            'maxJoursReservation' => 'required',
            'prix' => 'required',
            'voiture_id' => 'required',
            'saison_id' => 'required'
        ]);

        Price::create($data);

        return back()->with('success', 'Prix ajouté avec succès');
        //return redirect()->route('prices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $price = Price::find($id);

        return view('prices.show', compact('price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saisons = Saison::all();
        $voitures = Voiture::all();
        $price = Price::find($id);
        return view('prices.edit', compact('price', 'voitures', 'saisons'));
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
            'minJoursReservation' => 'required',
            'maxJoursReservation' => 'required',
            'prix' => 'required',
            'voiture_id' => 'required',
            'saison_id' => 'required'
        ]);

        Price::find($id)->update($data);

        return redirect()->route('prices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Price::find($id)->delete();

        return back()->with('success', 'Prix supprimer avec succès');
        //return redirect()->route('prices.index');
    }
}
