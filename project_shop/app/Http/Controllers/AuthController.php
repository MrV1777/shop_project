<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function index()
    {
        // If user is already logged in, redirect them to appropriate dashboard
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.home');
            }
        }
        
        return view('login.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Redirect based on user role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended(route('products.index'))
                            ->with('success', 'You have Successfully logged in as Admin');
            } else {
                return redirect()->intended(route('user.home'))
                            ->with('success', 'You have Successfully logged in');
            }
        }
       
        return redirect("login")->with('error', 'Oops! You have entered invalid credentials');
    }
    
    public function showRegistrationForm()
    {
        return view('login.register');
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
            'role' => 'user', // Default role for new registrations
        ]);

        Auth::login($user);

        // Redirect based on user role
        if ($user->role === 'admin') {
            return redirect()->intended(route('products.index'))
                        ->with('success', 'You have successfully registered and logged in as Admin!');
        } else {
            return redirect()->intended(route('user.home'))
                        ->with('success', 'You have successfully registered and logged in!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'You have been logged out successfully!');
    }
}