<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activities = ActivityLog::latest()->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }
    public function destroy($id)
{
    $log = ActivityLog::findOrFail($id);
    $log->delete();

    return redirect()->back()->with('success', 'Activity log deleted successfully.');
}

}
