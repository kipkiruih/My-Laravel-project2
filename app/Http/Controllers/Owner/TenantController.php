<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('user')->latest()->paginate(10);
        return view('owner.tenants.index', compact('tenants'));
    }

    public function show(Tenant $tenant)
    {
        return view('owner.tenants.show', compact('tenant'));
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('owner.tenants.index')->with('success', 'Tenant removed successfully.');
    }
    public function create()
    {
        return view('owner.tenants.create');
    }

    /**
     * Store a newly created tenant in the database.
     */
   
public function store(Request $request)
{
    // Validate request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:20|unique:users,phone',
        'address' => 'required|string|max:255',
        'password' => 'required|min:6|confirmed',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle profile image upload
    $profileImagePath = null;
    if ($request->hasFile('profile_image')) {
        $profileImagePath = $request->file('profile_image')->store('profile_pictures', 'public');
    }

    // Create user with role 'tenant'
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'role' => 'tenant', // Ensure correct role
        'password' => Hash::make($request->password),
        'profile_image' => $profileImagePath,
    ]);

    // Create tenant linked to the user
    Tenant::create([
        'user_id' => $user->id,
        'address' => $request->address,
    ]);

    return redirect()->route('owner.tenants.index')->with('success', 'Tenant added successfully!');
}
public function update(Request $request, $id)
{
    $tenant = Tenant::findOrFail($id);
    $user = $tenant->user;

    // Validate form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
        'address' => 'required|string|max:255',
        'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Handle profile image update
    if ($request->hasFile('profile_image')) {
        // Delete old image if exists
        if ($user->profile_image) {
            Storage::delete('public/' . $user->profile_image);
        }
        $profileImagePath = $request->file('profile_image')->store('profile_pictures', 'public');
        $user->profile_image = $profileImagePath;
    }

    // Update user details
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    // Update tenant address
    $tenant->update([
        'address' => $request->address,
    ]);

    return redirect()->route('owner.tenants.index')->with('success', 'Tenant updated successfully!');
}

public function edit($id)
{
    $tenant = Tenant::findOrFail($id);

    return view('owner.tenants.edit', compact('tenant'));
}

}

