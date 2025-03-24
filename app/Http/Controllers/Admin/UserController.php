<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;



class UserController extends Controller
{
    
    // Display all users
    public function index(Request $request)
{
    $query = User::query();

    // Check if a search query exists
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%")
              ->orWhere('phone', 'LIKE', "%{$search}%");
    }

    $users = $query->orderBy('created_at', 'desc')->paginate(10);
    $users = User::all();
    return view('admin.users.index', compact('users'));
}

    // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update user details
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    // Approve user account
    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        return redirect()->back()->with('success', 'User approved successfully.');
    }

    // Suspend user account
    public function suspend($id)
    {
        $user = User::findOrFail($id);
        $user->status = 'suspended';
        $user->save();

        return redirect()->back()->with('success', 'User suspended successfully.');
    }

    // Delete user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

   // use LogsActivity;
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        

        return redirect()->back()->with('success', 'User deleted successfully!');
    }
}
