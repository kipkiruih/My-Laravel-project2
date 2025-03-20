<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalApplication;
use App\Notifications\RentalApplicationUpdate;
use Illuminate\Support\Facades\Notification;

class OwnerRentalApplicationController extends Controller
{
    public function index()
    {
        // Get applications for properties owned by the logged-in owner
        $applications = RentalApplication::whereHas('property', function ($query) {
            $query->where('owner_id', auth()->id());
        })->latest()->get();
        $applications = RentalApplication::with(['tenant', 'property'])->paginate(10);


        return view('owner.rental_applications.index', compact('applications'));
    }

    public function show(RentalApplication $rentalApplication)
    {
        // Ensure the logged-in owner owns the property
        if ($rentalApplication->property->owner_id !== auth()->id()) {
            abort(403);
        }

        return view('owner.rental_applications.show', compact('rentalApplication'));
    }

    public function update(Request $request, RentalApplication $rentalApplication)
    {
        // Ensure only the property owner can update
        if ($rentalApplication->property->owner_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Approved,Rejected',
            'message' => 'nullable|string|max:255',
        ]);

        $rentalApplication->update([
            'status' => $request->status,
            'message' => $request->message,
        ]);

        // Notify the tenant
        Notification::send($rentalApplication->tenant, new RentalApplicationUpdate($rentalApplication, $request->status));

        return redirect()->route('owner.rental_applications.index')
            ->with('success', 'Application ' . strtolower($request->status) . ' successfully.');
    }
}
