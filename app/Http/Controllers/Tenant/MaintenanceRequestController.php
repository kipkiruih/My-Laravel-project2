<?php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintenanceRequestController extends Controller
{
    public function index()
    {
        $requests = MaintenanceRequest::where('tenant_id', Auth::id())->get();
        return view('tenant.maintenance.index', compact('requests'));
    }

    public function create()
    {
        // Manually fetch properties
        $properties = Property::whereIn('id', function ($query) {
            $query->select('property_id')
                  ->from('rental_applications')
                  ->where('tenant_id', auth()->id())
                  ->where('status', 'Approved');
        })->get();
    
      //  dd($properties); // Check if this returns properties
    
        return view('tenant.maintenance.create', compact('properties'));
    }
    


public function store(Request $request)
{
    $request->validate([
        'property_id' => 'required|exists:properties,id',
        'subject' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    MaintenanceRequest::create([
        'tenant_id' => auth()->id(),
        'property_id' => $request->property_id,
        'subject' => $request->subject,
        'description' => $request->description,
        'status' => 'Pending',
    ]);

    return redirect()->route('tenant.maintenance.index')->with('success', 'Maintenance request submitted successfully.');
}


    public function show(MaintenanceRequest $maintenanceRequest, $id)
    {
        $maintenanceRequest = MaintenanceRequest::with('property')->findOrFail($id);
        return view('tenant.maintenance.show', compact('maintenanceRequest'));
    }
}
