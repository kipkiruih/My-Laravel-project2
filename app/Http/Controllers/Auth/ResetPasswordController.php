<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password as PasswordRule;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Override the reset password method to enforce strong password validation.
     */
    public function reset(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => [
                'required',
                'confirmed',
                 PasswordRule ::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'password_confirmation' => ['required'],
            'token' => ['required']
        ]);
    
        // Attempt to reset the password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();
    
                // Manually log in the user after reset
                auth()->login($user);
            }
        );
    
        if ($status === Password::PASSWORD_RESET) {
            Session::flash('status', trans($status)); // Flash success message
    
            return redirect($this->redirectTo()); // Redirect after login
        }
    
        return back()->withErrors(['email' => [__($status)]]);
    }
    
    /**
     * Handle successful password reset response.
     */
    protected function sendResetResponse(Request $request, $response)
    {
        Session::flash('status', trans($response)); // Flash success message to session
        return redirect($this->redirectTo());
    }

    /**
     * Redirect users to their respective dashboards based on their role.
     */
    protected function redirectTo()
{
    return match (auth()->user()->role) {
        'admin' => '/admin/dashboard',
        'owner' => '/owner/dashboard',
        'tenant' => '/tenant/dashboard',
        default => '/',
    };
}

    
}
