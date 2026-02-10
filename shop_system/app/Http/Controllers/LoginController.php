<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Check user in MongoDB
        $user = User::where('email', $request->email)->first();

        if ($user && password_verify($request->password, $user->password)) {
            // Store user info in session
            Session::put('user', [
                'email' => $user->email,
                'name' => $user->name,
                'role' => $user->role,
            ]);
            
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Session::forget('user');
        return redirect('/login');
    }

    /**
     * Show the home page (after login).
     */
    public function home()
    {
        // Check if user is logged in via session
        if (!Session::has('user')) {
            return redirect('/login');
        }
        
        return view('home');
    }
}
