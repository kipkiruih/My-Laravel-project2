<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->account_status === 'deactivated') {
            Auth::logout();
            return redirect('/account/reactivate')->with('error', 'Your account is deactivated. Reactivate to regain access.');
        }

        return $next($request);
    }
}

