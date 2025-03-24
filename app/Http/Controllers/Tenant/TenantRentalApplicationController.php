<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalApplication;
use App\Models\Property;    
use App\Models\User;
use App\Notifications\RentalApplicationUpdate;
use App\Events\RentalApplicationUpdated;
use App\Models\ActivityLog;
class TenantRentalApplicationController extends Controller
{
    public function index()
    {
        ActivityLog::log('Viewed Rental Applications', 'Tenant #' . auth()->id() . ' viewed their rental applications.');

        $applications = RentalApplication::where('tenant_id', auth()->id())->latest()->get();
        return view('tenant.rental_applications.index', compact('applications'));
    }

    public function create()
    {
        ActivityLog::log('Accessed Rental Application Form', 'Tenant #' . auth()->id() . ' accessed the rental application creation page.');

        $properties = Property::all();
        return view('tenant.rental_applications.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'message' => 'nullable|string|max:1000',
        ]);

        $rentalApplication = RentalApplication::create([
            'property_id' => $request->property_id,
            'tenant_id' => auth()->id(),
            'message' => $request->message,
            'status' => 'Pending',
        ]);

        ActivityLog::log('Created Rental Application', 'Tenant #' . auth()->id() . ' submitted a rental application for Property #' . $request->property_id);

        return redirect()->route('tenant.rental_applications.index')
            ->with('success', 'Rental application submitted successfully.');
    }

    public function show(RentalApplication $rentalApplication)
    {
        if ($rentalApplication->tenant_id !== auth()->id()) {
            ActivityLog::log('Unauthorized Access Attempt', 'Tenant #' . auth()->id() . ' attempted to view unauthorized rental application #' . $rentalApplication->id);
            abort(403);
        }

        ActivityLog::log('Viewed Rental Application', 'Tenant #' . auth()->id() . ' viewed rental application #' . $rentalApplication->id);

        return view('tenant.rental_applications.show', compact('rentalApplication'));
    }

    public function destroy($id)
    {
        $application = RentalApplication::findOrFail($id);

        if ($application->tenant_id !== auth()->id()) {
            ActivityLog::log('Unauthorized Deletion Attempt', 'Tenant #' . auth()->id() . ' attempted to delete rental application #' . $id);
            abort(403);
        }

        $application->delete();

        ActivityLog::log('Deleted Rental Application', 'Tenant #' . auth()->id() . ' deleted rental application #' . $id);

        return redirect()->route('tenant.rental_applications.index')
            ->with('success', 'Rental application deleted successfully.');
    }

    public function edit(RentalApplication $rentalApplication)
    {
        if ($rentalApplication->tenant_id !== auth()->id() || $rentalApplication->status !== 'Pending') {
            ActivityLog::log('Unauthorized Edit Attempt', 'Tenant #' . auth()->id() . ' attempted to edit rental application #' . $rentalApplication->id);
            abort(403, 'You can only edit pending applications.');
        }

        ActivityLog::log('Accessed Edit Page', 'Tenant #' . auth()->id() . ' accessed the edit page for rental application #' . $rentalApplication->id);

        $properties = Property::all();
        return view('tenant.rental_applications.edit', compact('rentalApplication', 'properties'));
    }

    public function update(Request $request, RentalApplication $rentalApplication)
    {
        if ($rentalApplication->tenant_id !== auth()->id() || $rentalApplication->status !== 'Pending') {
            ActivityLog::log('Unauthorized Update Attempt', 'Tenant #' . auth()->id() . ' attempted to update rental application #' . $rentalApplication->id);
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

        ActivityLog::log('Updated Rental Application', 'Tenant #' . auth()->id() . ' updated rental application #' . $rentalApplication->id . ' for Property #' . $request->property_id);

        return redirect()->route('tenant.rental_applications.index')
            ->with('success', 'Rental application updated successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $application = RentalApplication::findOrFail($id);
        $oldStatus = $application->status;
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

        ActivityLog::log('Updated Rental Application Status', 'Tenant #' . auth()->id() . ' changed status of rental application #' . $id . ' from "' . $oldStatus . '" to "' . $request->status . '"');

        return redirect()->back()->with('success', 'Application status updated and notifications sent.');
    }
}
