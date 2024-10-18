<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
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
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }

    public function loginForm()
    {
        return view('auth.adminLogin');
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

    if ($user && $user->role === 'admin') {
        if (Auth::attempt($request->only('email', 'password'))) {
            session(['admin_id' => $user->id]);
            session(['admin_name' => $user->name]);
            return redirect()->route('reservations.index')->with('success', 'You are logged in!');
        } else {
            return back()->withErrors([
                'password' => 'The provided password is incorrect.',
            ]);
        }
    } else {
        // User not found or role is not 'client'
        return back()->withErrors([
            'email' => 'No user account found with the provided email.',
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
