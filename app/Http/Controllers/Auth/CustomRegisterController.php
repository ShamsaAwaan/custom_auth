<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CustomRegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

public function register(Request $request)
{
    // basic validation
    $request->validate([
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    // create user
    $user = User::create([
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'verify_token' => Str::random(60),
    ]);

    // send verification email
    Mail::send('emails.verify', ['token' => $user->verify_token], function ($message) use ($user) {
        $message->to($user->email);
        $message->subject('Verify Your Email');
    });

    return redirect()->route('login.show')
        ->with('success', 'Check your email to verify account!');
}

}
