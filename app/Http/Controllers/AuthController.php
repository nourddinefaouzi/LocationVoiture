<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'Tel' => 'string',
            'Permis' => 'string',
            'Adresse' => 'string',
            'cin' => 'nullable|unique:clients,cin',
            'passport' => 'nullable|unique:clients,passport',
            'cin_or_passport' => 'required_without_all:cin,passport',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        Client::create([
            'user_id' => $user->id,
            'Tel' => $request->Tel,
            'Permis' => $request->Permis,
            'Adresse' => $request->Adresse,
            'cin' => $request->cin,
            'passport' => $request->passport
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    // Validate email and password only
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Retrieve the user by email
    $user = User::where('email', $request->email)->first();

    // Check if the user exists and if their role is 'client'
    if ($user && $user->role === 'client') {
        // Now, attempt to authenticate the user with the provided password
        if (Auth::attempt($request->only('email', 'password'))) {

            // Check if the user has an associated client and store client_id in the session
            if ($user->client) {
                session(['client_id' => $user->client->id]);
            }

            return redirect()->route('welcome')->with('success', 'You are logged in!');
        } else {
            // Invalid password
            return back()->withErrors([
                'password' => 'The provided password is incorrect.',
            ]);
        }
    } else {
        // User not found or role is not 'client'
        return back()->withErrors([
            'email' => 'No client account found with the provided email.',
        ]);
    }
}


    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('welcome')->with('success', 'Logged out successfully.');
    }


}
