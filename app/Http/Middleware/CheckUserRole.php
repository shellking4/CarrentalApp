<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure $next
     * @param string $role
     * @return string|null
     */
    public function handle($request, Closure $next,  $role)
    {
        $user = $request->user();
        if (!$user->hasRole($role)) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
