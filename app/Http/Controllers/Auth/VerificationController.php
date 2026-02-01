<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    use App\Models\User;
use Carbon\Carbon;

public function verify($token)
{
    $user = User::where('verify_token', $token)->firstOrFail();

    $user->email_verified_at = now();
    $user->verify_token = null;
    $user->save();

    return redirect()->route('login.show')
        ->with('success', 'Email verified! You can login now.');
}
//
}
