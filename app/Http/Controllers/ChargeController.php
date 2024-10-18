<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Voiture;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $charges = Charge::all();

        return view('charges.index', compact('charges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $voitures = Voiture::all();

        return view('charges.create', compact('voitures'));
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
            'montant' => 'required|numeric',
            'date' => 'required|date',
            'motif' => 'required',
            'voiture_id' => 'required|exists:voitures,id',
        ]);

        Charge::create($data);

        return redirect()->route('charges.index')->with('success', 'La charge a été ajoutée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $charge = Charge::find($id);

        return view('charges.show', compact('charge'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $charge = Charge::find($id);
        $voitures = Voiture::all();

        return view('charges.edit', compact('charge', 'voitures'));
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
            'montant' => 'required|numeric',
            'date' => 'required|date',
            'motif' => 'required',
            'voiture_id' => 'required|exists:voitures,id',
        ]);

        Charge::find($id)->update($data);

        return redirect()->route('charges.index')->with('success', 'La charge a été modifiée');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Charge::find($id)->delete();

        return redirect()->route('charges.index')->with('success', 'La charge a été supprimée');

    }
}
