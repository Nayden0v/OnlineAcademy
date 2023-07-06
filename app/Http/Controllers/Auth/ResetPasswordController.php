<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {

        $request->validate([
            'token' => 'required',

            'password' => 'required|confirmed|min:6',
        ]);

        $token = $request->token;

        $password = $request->password;

        $user = User::where('password_reset_token', $token)->first();


        if ($user->password_reset_token != $token) {
            return redirect()->back()->withErrors(['token' => 'Invalid token.']);
        }


        $user->password = Hash::make($password);
        $user->password_reset_token = '';
        $user->save();

        return redirect('/login')->with('message', 'Your password has been successfully reset. Please log in with your new password.');
    }
}
