<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    
    /**
     * Display a listing of properties with search & filter options.
     */
    public function index(Request $request)
    {
        // Fetch search and filter inputs
        $search = $request->input('search');
        $property_type = $request->input('type');
        $location = $request->input('location');

        // Query properties with filters
        $properties = Property::when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%");
            })
            ->when($property_type, function ($query, $property_type) {
                return $query->where('category', $property_type);
            })
            ->when($location, function ($query, $location) {
                return $query->where('location', 'LIKE', "%{$location}%");
            })
            ->latest()
            ->paginate(9); // Paginate results
            $bookmarkedProperties = [];
            if (auth()->check() && auth()->user()->role === 'tenant') {
                $bookmarkedProperties = auth()->user()->bookmarks->pluck('property_id')->toArray();
            }
        
            return view('properties.index', compact('properties', 'bookmarkedProperties'));
    }

    /**
     * Display a single property.
     */
    public function show($id)
    {
        // Redirect to login if the user is not authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to view property details.');
        }

        $property = Property::with('owner')->findOrFail($id);

        // Check if the authenticated tenant has bookmarked the property
        $isBookmarked = false;
        if (Auth::check() && Auth::user()->role === 'tenant') {
            $isBookmarked = Bookmark::where('tenant_id', Auth::id())
                            ->where('property_id', $id)
                            ->exists();
        }

        return view('properties.show', compact('property', 'isBookmarked'));
    }

    /**
     * Display the homepage with the latest 6 properties.
     */
  /*public function home()
  {
    $properties = Property::latest()->take(6)->get(); // Get latest 6 properties
        return view('home', compact('properties'));
    }*/
}
