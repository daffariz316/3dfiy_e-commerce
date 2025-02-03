<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('user.login');
    }

    public function showSignupForm()
    {
        return view('user.signup');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('/dashboard')->with('success', 'Login successful');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();

    }

    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:8', // Membatasi password maksimal 8 karakter
            'phone_number' => 'required|digits_between:10,15',
        ]);

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);
        return redirect('/login')->with('success', 'Account created successfully');
    }

   public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showadlogin(){
        return view('admin.login');
    }
    public function adlogin(Request $request){
        // Validate the input
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Prepare the credentials for authentication
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the admin user
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed
            $admin = Auth::guard('admin')->user(); // Get the authenticated user
            $request->session()->put('admin', $admin); // Store admin data in session

            return redirect()->route('admin-dashboard')->with('success', 'Welcome back!');
        }

        // Authentication failed
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);
    }
    public function showadsignup(){
        return view('admin.signup');
    }
    public function adsignup(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|max:8', // Membatasi password maksimal 8 karakter
        ]);

        Admins::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);
        return redirect('/admin-login')->with('success', 'Account created successfully');
    }
    public function adlogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('admin-login')->with('success', 'Logged out successfully.');
    }
}
