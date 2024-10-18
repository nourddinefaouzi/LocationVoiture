<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('client')->get();
        return view('clients.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userData = $request->validate([
            'name' => 'string',
            'email' => 'string',
            'password' => 'string'
        ]);
 
        $clientData = $request->validate([
            'Tel' => 'string',
            'Permis' => 'string',
            'Adresse' => 'string',
            'cin' => 'nullable|unique:clients,cin',
            'passport' => 'nullable|unique:clients,passport',
            'cin_or_passport' => 'required_without_all:cin,passport',
        ]);

        $userData['role'] = 'client';

        $userData['password'] = Hash::make($userData['password']);
        
        $user = User::create($userData);

        $user->client()->create($clientData);

        return redirect()->route('clients.index')->with('success', 'Client added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('client')->findOrFail($id);
        return view('clients.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('client')->findOrFail($id);
        return view('clients.edit', compact('user'));
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
        $user = User::findOrFail($id);

        $userData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'sometimes|nullable|min:8|confirmed',
        ]);

        if (!empty($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        } else {
            unset($userData['password']);
        }

        // Get the client associated with the user
        $client = $user->client;

        // Validate client data
        $clientData = $request->validate([
            'Tel' => 'required|string|max:15',
            'Permis' => 'required|string|max:255',
            'Adresse' => 'required|string|max:255',
            'cin' => [
                'nullable',
                Rule::unique('clients', 'cin')->ignore($client->id), // Correctly referencing the client's id
            ],
            'passport' => [
                'nullable',
                Rule::unique('clients', 'passport')->ignore($client->id), // Correctly referencing the client's id
            ],
            // Ensure at least one is required
            'cin_or_passport' => 'required_without_all:cin,passport',
        ]);

        // Update user data
        $userData['role'] = 'client';
        $user->update($userData);

        // Update client data
        $client->update($clientData);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('clients.index')->with('danger', 'Client deleted successfully');
    }
}
