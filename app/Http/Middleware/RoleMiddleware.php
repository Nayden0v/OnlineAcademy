<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    protected $roles = [
        'admin' => 'admin',
        'teacher' => 'teacher',
        'student' => 'student',
        'employer' => 'employer',
        'regular' => 'regular',
    ];
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect('/')->with('message', 'Login to access the website info');
        }

        $roleModel = Role::where('name', $role)->first();
        if (!$roleModel || auth()->user()->role_id !== $roleModel->id) {
            return redirect(to: '/')->with('error', 'You are not '.$role.'!');
        }

        return $next($request);
    }
}
