<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\Models\Property;
use App\Models\User;
use App\Models\RentalApplication;
use App\Models\Payment;
use Carbon\Carbon;
//use Spatie\Activitylog\Models\Activity;   


class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProperties = Property::count(); // Get total properties count
        $totalUsers = User::count(); // Total users
        $pendingApplications = RentalApplication::where('status', 'pending')->count(); // Pending applications
        $totalPayments = Payment::where('created_at', '>=', Carbon::now()->subDays(30))->sum('amount'); // Payments in last 30 days
        return view('admin.dashboard',compact('totalProperties','totalUsers','pendingApplications','totalPayments'));
    }

}