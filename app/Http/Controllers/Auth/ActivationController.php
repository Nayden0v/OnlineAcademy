<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
        public function activating(Request $request)
    {
        $user = User::where('activation_token', $request->token)->firstOrFail();

        $user->update([
            'activation_token' => '',
            'email_verified_at' => now(),
            'active' => 1,
        ]);

        auth()->login($user);

        return redirect('/')->with('message', 'Your account has been activated. You are now logged in.');
    }
}
