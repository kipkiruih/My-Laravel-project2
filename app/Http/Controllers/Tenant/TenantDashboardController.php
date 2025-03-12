<?php
namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Notifications\RentPaymentReminder;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\RentalApplication;
use App\Models\Bookmark;
class TenantDashboardController extends Controller
{
    public function index()
    { // Fetch the notifications
        $notifications = Auth::user()->notifications;
        Auth::user()->unreadNotifications->markAsRead();
        $tenant = User::find(auth()->id());
        $tenant->notify(new RentPaymentReminder());

        $tenantId = auth()->id();

          // Fetch the next due payment
    $upcomingPayment = Payment::where('tenant_id', $tenantId)
    ->where('status', 'Pending')
    ->where('due_date', '>=', Carbon::now())
    ->orderBy('due_date', 'asc')
    ->first();
    // Fetch the total payments made in the last 6 months

    $sixMonthsAgo = Carbon::now()->subMonths(6);

    $totalPayments = Payment::where('tenant_id', $tenantId)
                            ->where('created_at', '>=', $sixMonthsAgo)
                            ->sum('amount');
// Fetch the total number of occupied rentals
                  $occupiedRentals = RentalApplication::where('tenant_id', $tenantId)
                    ->where('status', 'approved') // Assuming 'approved' means rented
                    ->count();
                    // Fetch the total number of bookmarked properties
                    $bookmarkedProperties = Bookmark::where('tenant_id', $tenantId)->count();

                    // Fetch the total number of pending applications
                    $pendingApplications = RentalApplication::where('tenant_id', $tenantId)
        ->where('status', 'pending')
        ->count();


    return view('tenant.dashboard', compact('notifications','upcomingPayment', 'totalPayments', 'occupiedRentals'
    ,'bookmarkedProperties','pendingApplications'));    

    }
   // public function dashboard()
//{
  //  $tenantId = Auth::id();
//
  ///  $occupiedRentals = RentalApplication::where('tenant_id', $tenantId)
     //                                   ->where('status', 'approved') // Assuming 'approved' means rented
       ///                                 ->count();

    //return view('tenant.dashboard', compact('occupiedRentals'));
//}

}