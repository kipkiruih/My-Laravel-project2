<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginActivityController extends Controller
{
    public function index()
    {
        $activities = DB::table('login_activities')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->take(10) // Show last 10 logins
            ->get();

        return view('account.login-activity', compact('activities'));
    }
}
