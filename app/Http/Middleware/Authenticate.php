<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }
    
public function handle($request, Closure $next, ...$guards)
{
    if (Auth::check() && Auth::user()->isDeactivated()) {
        Auth::logout(); // Log out deactivated users
        return redirect('/login')->with('error', 'Your account is deactivated. Contact support.');
    }

    return $next($request);
}
}
