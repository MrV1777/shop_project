<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->with('success', 'You have Successfully logged in');
        }
      
        return redirect("login")->with('error', 'Oppes! You have entered invalid credentials');
    }
    public function showRegistrationForm()
    {
        return view('register');
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
        ]);

        Auth::login($user);

        return redirect()->intended('dashboard')
                    ->with('success', 'You have successfully registered and logged in!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'You have been logged out successfully!');
    }
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\View\View; 
use App\Models\User; 
use Illuminate\Http\RedirectResponse; 
class AuthController extends Controller
{
 public function index(): View
 {
 return view('auth.login');
 }
 public function registration(): View
 {
 return view('auth.registration');
 }
 public function postLogin(Request $request): RedirectResponse
 {
 $request->validate([
 'email' => 'required',
 'password' => 'required',
 ]);
 
 $credentials = $request->only('email', 'password'); 
 if (Auth::attempt($credentials)) { // Check ຖາ້ມຂີໍມ້ ູນໃຫໄ້ປໜາ້ 'dashboard'
 return redirect()->intended('dashboard')
 ->withSuccess('You have Successfully loggedin');
 }
 return redirect("login")->withError('You have entered invalid credentials!'); 
 }
 public function postRegistration(Request $request): RedirectResponse 
 {
 $request->validate([ 
 'name' => 'required',
 'email' => 'required|email|unique:users',
 'password' => 'required|min:6',
 ]);
 
 $data = $request->all();
 $check = $this->create($data); 
 Auth::login($check); // ກວດສອບຫາກສໍາເລດັ ໃຫ້redirect ໄປໜາ້ Login
 
 return redirect("login")->withSuccess('Great! You have Successfully loggedin');
 }
 public function dashboard()
 {
 if(Auth::check()){ 
 return view('dashboard');
 }
 return redirect("login")->withError('You are not allowed to access'); 
 }
 public function create(array $data) // ບນັທກຂຶ ໍມ້ ູນລງົໃນຕາຕະລາງ user
 {
 return User::create([
 'name' => $data['name'],
 'email' => $data['email'],
 'password' => Hash::make($data['password']),
 ]);
 
 public function logout(): RedirectResponse {
 Session::flush();
 Auth::logout();
 return redirect('login')->withSuccess('You have successfully logged out'); 
 }
}