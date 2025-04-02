<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class AccountController extends Controller
{
    public function deactivate(Request $request)
    {
        $user = Auth::user();
        $user->update(['deactivated_at' => now()]); // Mark account as deactivated
        Auth::logout(); // Log the user out

        return redirect('/login')->with('status', 'Your account has been deactivated.');
    }

     // Show Deactivate Account Page
     public function showDeactivatePage()
     {
         return view('account.deactivate'); 
     }
    public function reactivate(Request $request)
    {
        // Validate the email input
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
    
        // Find the user by email
        $user = User::where('email', $request->email)->first();
    
        // Check if the account is actually deactivated
        if (!$user || is_null($user->deactivated_at)) {
            return redirect()->back()->with('error', 'Your account is already active or does not exist.');
        }
    
        // Reactivate the account
        $user->update(['deactivated_at' => null]);
    
        // Log the user in after reactivation
        Auth::login($user);
    
        // Redirect based on user role
        return $this->redirectUser($user);
    }
    
    // Function to redirect users based on roles
    private function redirectUser($user)
    {
        if ($user->role === 'Admin') {
            return redirect()->route('admin.dashboard')->with('status', 'Your account has been reactivated.');
        } elseif ($user->role === 'Owner') {
            return redirect()->route('owner.dashboard')->with('status', 'Your account has been reactivated.');
        } elseif ($user->role === 'Tenant') {
            return redirect()->route('tenant.dashboard')->with('status', 'Your account has been reactivated.');
        } else {
            return redirect('/')->with('status', 'Your account has been reactivated.');
        }
    }

}