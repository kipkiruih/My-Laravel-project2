<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:10', 'max:15', 'unique:users'],
            'role' => ['required', 'string', 'in:tenant,owner,admin'],
'profile_image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'password' => [
                'required', 'string', 'min:8', 'confirmed',
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[\W]/',  // At least one special character
            ],
        ], [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'role.in' => 'The role must be either Tenant, Owner, or Admin.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
{
    $profileImagePath = null;
    
    // Check if a profile image is uploaded
    if (request()->hasFile('profile_image')) {
        $profileImagePath = request()->file('profile_image')->store('profile_images', 'public');
    }

    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'role' => $data['role'],
        'profile_image' => $profileImagePath, // Save image path
        'password' => Hash::make($data['password']),
    ]);
}

// Add this method to handle redirection after registration
protected function registered(Request $request, $user)
{
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'owner') {
        return redirect('/owner/dashboard');
    } elseif ($user->role === 'tenant') {
        return redirect('/tenant/dashboard');
    }

    return redirect('/home'); // Default fallback
}
}
