<?php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarks = Bookmark::where('tenant_id', Auth::id())->with('property')->get();
        return view('tenant.bookmarks.index', compact('bookmarks'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Ensure the user is a tenant
        if ($user->role !== 'tenant') {
            return redirect()->back()->with('error', 'Only tenants can bookmark properties.');
        }

        // Check if property already bookmarked
        $existingBookmark = Bookmark::where('tenant_id', $user->id)
                                    ->where('property_id', $request->property_id)
                                    ->first();

        if ($existingBookmark) {
            return redirect()->back()->with('info', 'Property already bookmarked.');
        }

        // Create a new bookmark
        Bookmark::create([
            'tenant_id' => $user->id,
            'property_id' => $request->property_id,
        ]);

        return redirect()->back()->with('success', 'Property bookmarked successfully!');
    }

    public function destroy($id)
    {
        $bookmark = Bookmark::where('tenant_id', Auth::id())->where('id', $id)->first();
        if ($bookmark) {
            $bookmark->delete();
            return back()->with('success', 'Bookmark removed.');
        }
        return back()->with('error', 'Bookmark not found.');
    }
}
