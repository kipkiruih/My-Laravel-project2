<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalApplication;

class RentalApplicationController extends Controller
{
    // Display all rental applications
    public function index()
    {
        $applications = RentalApplication::with(['tenant', 'property', 'owner'])->get();
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
