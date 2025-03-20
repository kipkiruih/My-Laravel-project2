<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use PharIo\Manifest\Email;

class TenantController extends Controller
{
    public function index(Request $request)
    {
        $query = Tenant::with('user');

        // Search Functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Sorting Functionality (Fix)
        $sort = $request->get('sort', 'tenants.name');
        $direction = $request->get('direction', 'asc');

        $query->join('users', 'tenants.user_id', '=', 'users.id')
              ->orderBy("$sort", $direction)
              ->select('tenants.*');

        $tenants = $query->paginate(10);

        return view('owner.tenants.index', compact('tenants'));
    }

    public function create()
    {
        return view('owner.tenants.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:15|unique:users,phone',
            'password' => 'required|min:6|confirmed',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            // Handle profile image upload
            $profileImagePath = null;
            if ($request->hasFile('profile_image')) {
                $profileImagePath = $request->file('profile_image')->store('profile_pictures', 'public');
            }

            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'tenant',
                'profile_image' => $profileImagePath,
            ]);

            // Create tenant
            Tenant::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'name' => $request->name,   
                'password' => Hash::make($request->password),

            ]);
        });

        return redirect()->route('owner.tenants.index')->with('success', 'Tenant added successfully!');
    }

    public function show(Tenant $tenant)
    {
        return view('owner.tenants.show', compact('tenant'));
    }

    public function edit($id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('owner.tenants.edit', compact('tenant'));
    }

    public function update(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);
        $user = $tenant->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'address' => 'required|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle profile image update
        if ($request->hasFile('profile_image')) {
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

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('owner.tenants.index')->with('success', 'Tenant removed successfully.');
    }
}
