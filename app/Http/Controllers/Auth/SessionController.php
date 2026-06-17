<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SessionController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Login');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            Inertia::flash('toast', [
                'type' => 'success',
                'text' => "Welcome Back, {$request->user()->name}"
            ]);
            return redirect()->intended('/dashboard');
        }

        Inertia::flash('toast', [
            'type' => 'warning',
            'text' => 'Invalid email or password.'
        ]);
        
        return back()->withErrors([
            'auth' => 'The provided email and/or password is incorrect.'
        ]);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
