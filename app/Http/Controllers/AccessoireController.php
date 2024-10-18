<?php

namespace App\Http\Controllers;

use App\Models\Accessoire;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AccessoireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accessoires = Accessoire::all();
        return view('accessoires.index', compact('accessoires'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accessoires.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'prixType' => 'required',
            'quantite' => 'required',
            'max' => 'required',
            'image' => 'required'
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('accessoires', 'public');
        }

        // Save accessoire data
        Accessoire::create([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'prixType' => $request->prixType,
            'quantite' => $request->quantite,
            'max' => $request->max,
            'image' => $imagePath ?? null, // Save the image path if uploaded
        ]);

        return redirect()->route('accessoires.index')->with('success', 'accessoire ajoute avec succes');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $accessoire = Accessoire::find($id);
        $reservations = $accessoire->reservations;
        return view('accessoires.show', compact('accessoire', 'reservations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accessoire = Accessoire::find($id);
        return view('accessoires.edit', compact('accessoire'));
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
        $request->validate([
            'nom' => 'required',
            'description' => 'required',
            'prix' => 'required',
            'prixType' => 'required',
            'quantite' => 'required',
            'max' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add this line
        ]);

        $accessoire = Accessoire::find($id);
        // Handle file upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($accessoire->image && Storage::disk('public')->exists($accessoire->image)) {
                Storage::disk('public')->delete($accessoire->image);
            }

            // Upload the new image
            $imagePath = $request->file('image')->store('accessoires', 'public');
        } else {
            $imagePath = $accessoire->image; // Keep the old image if no new image is uploaded
        }

        // Save accessoire data
        $accessoire->update([
            'nom' => $request->nom,
            'description' => $request->description,
            'prix' => $request->prix,
            'prixType' => $request->prixType,
            'quantite' => $request->quantite,
            'max' => $request->max,
            'image' => $imagePath ?? null, // Save the image path if uploaded
        ]);

        return redirect()->route('accessoires.index')->with('success', 'accessoire ajoute avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Accessoire::find($id)->delete();
        return redirect()->route('accessoires.index')->with('danger', 'accessoire supprimer avec succes');
    }
}
