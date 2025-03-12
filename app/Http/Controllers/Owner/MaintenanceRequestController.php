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
            'status' => 'required|string|max:255' // Ensure valid input
        ]);
    
        $maintenanceRequest = MaintenanceRequest::whereHas('property', function ($query) {
            $query->where('owner_id', Auth::id());
        })->findOrFail($id);
    
        $maintenanceRequest->update([
            'status' => trim($request->status) // Ensure it's a string
        ]);
    
        return redirect()->route('owner.maintenance.index')->with('success', 'Maintenance request updated successfully.');
    }
    
    
}
