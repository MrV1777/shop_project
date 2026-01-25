<?php
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
 public function create(array $data) 
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