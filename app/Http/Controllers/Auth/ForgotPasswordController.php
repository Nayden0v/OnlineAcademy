<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Http\Controllers\Auth\ResetPasswordController;

class ForgotPasswordController extends Controller
{

    public function showLinkRequestForm() {
        return view('auth.passwords.email');
    }

 public function sendResetLinkEmail(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $user = User::where('email', $request->email)->first();


        $token = Str::random(60);


        $user->password_reset_token = $token;
        $user->save();


        $resetUrl = route('password.reset', ['token' => $token]);


        Mail::send('auth.passwords.email_reset_link', ['resetUrl' => $resetUrl, 'name' => $user->name], function($message) use ($user) {
            $message->to($user->email);
            $message->subject('Reset your password');
        });

        return redirect('/')->with('message', 'Password reset link sent. Please check your email.');
    }
}
