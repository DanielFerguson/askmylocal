<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // If the user is already logged in, redirect to the home page
        if (Auth::check()) {
            // Get the user's locality
            $locality = Auth::user()->locality;

            $state = strtolower(str_replace(' ', '-', $locality->state));
            $name = strtolower(str_replace(' ', '-', $locality->name));

            return redirect()->route('locality', ['state' => $state, 'locality' => $name]);
        }

        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($validated, $request->boolean('remember_me'))) {
            $request->session()->regenerate();

            $state = strtolower(str_replace(' ', '-', Auth::user()->locality->state));
            $name = strtolower(str_replace(' ', '-', Auth::user()->locality->name));

            $first_name = explode(' ', Auth::user()->name)[0];

            // Redirect to home or dashboard
            return redirect()->intended(route('locality', ['state' => $state, 'locality' => $name]))
                ->with('success', 'Welcome back, '.$first_name.'!');
        }

        // Redirect to login page with error message
        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect()->route('home')->with('success', 'Logout successful!');
    }
}
