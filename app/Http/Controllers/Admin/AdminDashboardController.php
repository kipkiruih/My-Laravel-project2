<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
//use Spatie\Activitylog\Models\Activity;   


class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

}