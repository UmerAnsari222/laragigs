<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // show register form
    public function create()
    {
        return view('users.register');
    }

    // create user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|confirmed'
        ]);

        // Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);

        auth()->login($user);

        return redirect('/')->with('message', 'user create and loggin successfully!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'Logout successfully!');
    }

    public function login()
    {
        return view('users.login');
    }

    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($formFields)) {
            $request->session()->regenerate();
            return redirect('/')->with('message', 'Login successfully!');
        }

        return back()->withErrors([
            'email' => 'The Invalid credentials.',
        ])->onlyInput('email');
    }
}
