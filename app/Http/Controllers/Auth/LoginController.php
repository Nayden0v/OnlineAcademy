<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $userFields = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $remember = $request->input('remember');

        if (Auth::attempt($userFields, $remember)) {
            $user = auth()->user();
            if ($user->active == 0) {
                Auth::logout();
                return back()->withErrors([
                    'name' => 'Please activate your account before logging in.',
                ]);
            }

            $request->session()->regenerate();
            return redirect('/')->with('message', "Welcome, $user->name!");;
        }

        return back()->withErrors(['name' => 'Invalid Credentials']);
    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Hope to see you soon!');
    }
}
