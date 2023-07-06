<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\UserActivationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRegForm() {
        return view('emails.register');
    }

    public function createUser(Request $request) {

        $request->validate([
            'email' => 'required|max:50|email|unique:users',
            'name' => 'required|max:20|min:3|unique:users',
            'password' => 'required|min:4',
            'password_again' => 'required|same:password'
        ]);

             // Generate activation token
        $activation_token = Str::random(60);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'activation_token' => $activation_token,
            'active' => 0,
            'remember_token' => '',
            'password_reset_token' => '',
        ]);

        $activationUrl = route('activate', ['token' => $activation_token]);
        Mail::to($user->email)->send(new UserActivationMail($user->name, $activationUrl));


        return redirect('/')->with('message', 'Registered successfully. Please check your email to activate your account.');
    }



}
