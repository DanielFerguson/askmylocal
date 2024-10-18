<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Locality;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // If the user is already logged in, redirect to the home page
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $localities = Locality::orderBy('state', 'asc')->orderBy('name', 'asc')->get();

        return view('register', compact('localities'));
    }

    public function register(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'locality' => 'required|exists:localities,id',
            'remember_me' => 'nullable|accepted',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'locality_id' => $validated['locality'],
        ]);

        // Log the user in
        Auth::login($user, $validated['remember_me']);

        // Redirect to home or dashboard
        return redirect()->route('home')->with('success', 'Registration successful!');
    }
}
