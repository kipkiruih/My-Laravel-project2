<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\User;



class OwnerDashboardController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->unreadNotifications;

        // Mark notifications as read
        Auth::user()->unreadNotifications->markAsRead();
        $ownerId = Auth::id(); // Get the logged-in owner
        // Count total properties owned by the logged-in owner
        $totalProperties = Property::where('owner_id', $ownerId)->count();

        $totalTenants = User::whereHas('rentalApplications', function ($query) use ($ownerId) {
            $query->whereHas('property', function ($subQuery) use ($ownerId) {
                $subQuery->where('owner_id', $ownerId);
            });
        })->count();

         // Sum all payments for properties owned by the owner
    $totalEarnings = Payment::whereHas('property', function ($query) use ($ownerId) {
        $query->where('owner_id', $ownerId);
    })->sum('amount');

        return view('owner.dashboard', compact('notifications', 
        'totalProperties'
        , 'totalTenants'
        , 'totalEarnings'));
    }

public function payments()
{
    $ownerId = Auth::id(); // Get logged-in owner

    // Fetch payments for properties owned by the logged-in owner
    $payments = Payment::whereHas('property', function ($query) use ($ownerId) {
        $query->where('owner_id', $ownerId);
    })->latest()->paginate(10);

    return view('owner.payments.index', compact('payments'));
}
public function downloadInvoice($id)
{
    $payment = Payment::findOrFail($id);

    $pdf = pdf::loadView('owner.payments.invoice', compact('payment'));
    return $pdf->download('invoice_' . $payment->id . '.pdf');
}

public function requestReactivation()
{
    $user = Auth::user();

    if (!$user->is_deactivated) {
        return redirect()->back()->with('info', 'Your account is already active.');
    }

    // Notify the admin (optional: log the request)
    \Log::info("Reactivation request from: {$user->email}");

    return redirect()->back()->with('success', 'Reactivation request sent. Please wait for admin approval.');
}
}