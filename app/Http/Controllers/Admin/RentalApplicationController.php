<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalApplication;

class RentalApplicationController extends Controller
{
    // Display all rental applications
    public function index(Request $request)
{
    $applications = RentalApplication::with(['tenant', 'property', 'owner'])->get();
    $sort = $request->query('sort', 'created_at'); // Default sorting
    $applications = RentalApplication::with(['tenant', 'property.owner'])
        ->when($sort == 'tenant', fn($query) => $query->orderBy('tenant_id'))
        ->when($sort == 'property', fn($query) => $query->orderBy('property_id'))
        ->when($sort == 'owner', fn($query) => $query->orderBy('property.owner_id'))
        ->latest()
        ->paginate(10);

    return view('admin.rental-applications.index', compact('applications'));
}


    // Show application details
    public function show($id)
    {
        $application = RentalApplication::with(['tenant', 'property', 'owner'])->findOrFail($id);
        return view('admin.rental-applications.show', compact('application'));
    }

    // Intervene in disputes (e.g., mark as resolved)
    public function resolveDispute($id)
    {
        $application = RentalApplication::findOrFail($id);
        $application->status = 'resolved';
        $application->save();

        return redirect()->back()->with('success', 'Dispute resolved successfully.');
    }
}
