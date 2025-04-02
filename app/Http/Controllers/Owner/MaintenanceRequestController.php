<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        // Get all maintenance requests for the owner's properties
        $maintenanceRequests = MaintenanceRequest::whereHas('property', function ($query) {
            $query->where('owner_id', Auth::id());
        })->get();

        return view('owner.maintenance.index', compact('maintenanceRequests'));
    }

    public function show($id)
    {
        // Fetch the maintenance request details, ensuring it belongs to the owner
        $maintenanceRequest = MaintenanceRequest::whereHas('property', function ($query) {
            $query->where('owner_id', Auth::id());
        })->findOrFail($id);

        return view('owner.maintenance.show', compact('maintenanceRequest'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required|string|max:255'
    ]);

    // Define valid statuses matching ENUM values
    $validStatuses = [
        'Pending' => 'Pending',
        'in_progress' => 'In Progress',
        'completed' => 'Completed'
    ];

    // Ensure the status exists in ENUM values
    if (!array_key_exists($request->status, $validStatuses)) {
        return back()->withErrors(['status' => 'Invalid status value']);
    }

    $maintenanceRequest = MaintenanceRequest::whereHas('property', function ($query) {
        $query->where('owner_id', Auth::id());
    })->findOrFail($id);

    // Update the status with the correct ENUM format
    $maintenanceRequest->update([
        'status' => $validStatuses[$request->status]
    ]);

    return redirect()->route('owner.maintenance.index')->with('success', 'Maintenance request updated successfully.');
}

    
}
