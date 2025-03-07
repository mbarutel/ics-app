<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth/register');
    }

    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'firstName' => ['required', 'min:3', 'max:30'],
            'lastName' => ['required', 'min:3', 'max:30'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'first_name' => $incomingFields['firstName'],
            'last_name' => $incomingFields['lastName'],
            'email' => $incomingFields['email'],
            'password' => Hash::make($incomingFields['password']),
        ]);

        auth()->login($user);

        return redirect('/')->with('success', 'You have successfully registered!');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if (auth()->attempt(['email' => $incomingFields['email'], 'password' => $incomingFields['password']])) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You have successfully logged in!');
        } else {
            return redirect('/')->with('failure', 'Your credentials were incorrect! Please try again.');
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You have successfully logged out!');
    }
}
