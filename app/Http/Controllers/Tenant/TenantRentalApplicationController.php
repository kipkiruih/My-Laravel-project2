<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalApplication;
use App\Models\Property;    
use App\Models\User;
use App\Notifications\RentalApplicationUpdate;
use App\Events\RentalApplicationUpdated;

use Illuminate\Support\Facades\Notification;

class TenantRentalApplicationController extends Controller
{
    public function index()
    {
        $applications = RentalApplication::where('tenant_id', auth()->id())->latest()->get();
        return view('tenant.rental_applications.index', compact('applications'));
    }

    public function create()
    {
        $properties = Property::all();
        return view('tenant.rental_applications.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'message' => 'nullable|string|max:1000',
        ]);

        $property = Property::findOrFail($request->property_id);

        $rentalApplication = RentalApplication::create([
            'property_id' => $request->property_id,
            'tenant_id' => auth()->id(), // Assuming tenant is logged in
            'message' => $request->message,
            'status' => 'Pending', // Default status
        ]);

        return redirect()->route('tenant.rental_applications.index')
            ->with('success', 'Rental application submitted successfully.');
    }

    public function show(RentalApplication $rentalApplication)
    {
        if ($rentalApplication->tenant_id !== auth()->id()) {
            abort(403);
        }

        return view('tenant.rental_applications.show', compact('rentalApplication'));
    }

    public function destroy($id)
    {
        $application = RentalApplication::findOrFail($id);
        $application->delete();

        return redirect()->route('tenant.rental_applications.index')->with('success', 'Rental application deleted successfully.');
    }

    public function edit(RentalApplication $rentalApplication)
    {
        // Ensure only the owner of the application can edit it
        if ($rentalApplication->tenant_id !== auth()->id() || $rentalApplication->status !== 'Pending') {
            abort(403, 'You can only edit pending applications.');
        }

        $properties = Property::all();
        return view('tenant.rental_applications.edit', compact('rentalApplication', 'properties'));
    }

    public function update(Request $request, RentalApplication $rentalApplication)
    {
        // Ensure only the tenant who made the application can update it
        if ($rentalApplication->tenant_id !== auth()->id() || $rentalApplication->status !== 'Pending') {
            abort(403, 'You can only update pending applications.');
        }

        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'message' => 'nullable|string|max:500',
        ]);

        $rentalApplication->update([
            'property_id' => $request->property_id,
            'message' => $request->message,
        ]);

        return redirect()->route('tenant.rental_applications.index')
            ->with('success', 'Rental application updated successfully.');
    }

    // Update rental application status
    public function updateStatus(Request $request, $id)
    {
        $application = RentalApplication::findOrFail($id);
        $application->status = $request->status;
        $application->save();

        // Notify the Tenant
        $tenant = User::find($application->tenant_id);
        $tenant->notify(new RentalApplicationUpdate($application, $request->status));

        // Notify the Owner
        $owner = User::find($application->property->owner_id);
        $owner->notify(new RentalApplicationUpdate($application, "updated"));

        // Broadcast for real-time updates
        broadcast(new RentalApplicationUpdated($application))->toOthers();

        return redirect()->back()->with('success', 'Application status updated and notifications sent.');
    }
}
