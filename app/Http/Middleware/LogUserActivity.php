<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Schema;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $agent = new Agent(); // Detect device info
            $ip = $request->ip();
            $device = $agent->device();
            $browser = $agent->browser();
            $platform = $agent->platform();

            // Save login activity in the database
            DB::table('login_activities')->insert([
                'user_id' => Auth::id(),
                'ip_address' => $ip,
                'device' => $device,
                'browser' => $browser,
                'platform' => $platform,
                'created_at' => now(),
            ]);
        }

        return $next($request);
    }
}
