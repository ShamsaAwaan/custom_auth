<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify($token)
    {
        $user = User::where('verify_token', $token)->first();

        if (!$user) {
            return redirect()->route('login.show')->with('error', 'Invalid verification link.');
        }

        $user->email_verified_at = now();
        $user->verify_token = null;
        $user->save();

        return redirect()->route('login.show')->with('success', 'Email verified! You can now login.');
    }
}
