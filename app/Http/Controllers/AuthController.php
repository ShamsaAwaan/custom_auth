<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // =========================
    // SHOW PAGES
    // =========================

    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    // =========================
    // REGISTER
    // =========================

    public function register(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6|confirmed',
        ]);

        $token = Str::random(64);

        $user = User::create([
            'firstname'    => $request->firstname,
            'lastname'     => $request->lastname,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'verify_token' => $token,
            'is_verified'  => 0,
        ]);

        Mail::send('emails.verify', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Verify Your Email');
        });

        return view('auth.verify_notice');
    }

    // =========================
    // VERIFY EMAIL
    // =========================

    public function verify($token)
    {
        $user = User::where('verify_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Invalid or expired verification link.');
        }

        $user->update([
            'verify_token' => null,
            'is_verified'  => 1,
        ]);

        return redirect()->route('login')
            ->with('success', 'Email verified successfully. Please login.');
    }

    // =========================
    // LOGIN
    // =========================

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('dashboard')
                ->with('success', 'Welcome!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    // =========================
    // DASHBOARD
    // =========================

    public function dashboard()
    {
        return view('dashboard');
    }

    // =========================
    // LOGOUT
    // =========================

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }
}
