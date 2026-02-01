<?php

namespace App\Http\Middleware;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\User;

class AuthMiddleware
{
    public function register(Request $request)
{
    $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8',
    ]);

    $token = Str::random(64); // generate verification token

    $user = User::create([
        'firstname' => $request->firstname,
        'lastname' => $request->lastname,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'verify_token' => $token,
        'is_verified' => 0,
    ]);

    // send verification email
    Mail::send('emails.verify', ['token' => $token], function($message) use ($request){
        $message->to($request->email);
        $message->subject('Verify your email address');
    });

    return redirect('/login')->with('success', 'We have sent you an email to verify your account.');
    }
}
