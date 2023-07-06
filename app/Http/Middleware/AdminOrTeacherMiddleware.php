<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminOrTeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role->name === 'admin' || $user->role->name === 'teacher') {
                return $next($request);
            } else {
                return redirect('/')->with('error', 'You must be admin or teacher!');
            }
        } else {
            return redirect('/')->with('message', 'Login to access the website info');
        }
    }
}
