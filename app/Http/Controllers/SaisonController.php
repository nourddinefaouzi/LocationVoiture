<?php

namespace App\Http\Controllers;

use App\Models\Saison;
use App\Models\Voiture;
use Illuminate\Http\Request;

class SaisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saisons = Saison::all();
        return view('saisons.index', compact('saisons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('saisons.create');
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
            'nom' => 'string',
            'debutSaison' => 'string',
            'finSaison' => 'string',
        ]);

        Saison::create($data);

        return redirect()->route('saisons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $saison = Saison::find($id);

        return view('saisons.show', compact('saison'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saison = Saison::find($id);
        return view('saisons.edit', compact('saison'));
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
            'nom' => 'string',
            'debutSaison' => 'string',
            'finSaison' => 'string',
        ]);

        Saison::find($id)->update($data);

        return redirect()->route('saisons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Saison::find($id)->delete();
        return redirect()->route('saisons.index');
    }
}
