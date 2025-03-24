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
        $propertyType = $request->input('type');
        $location = $request->input('location');
    
        // Query properties with filters and eager load ratings
        $properties = Property::with('ratings')
            ->when($search, function ($query, $search) {
                return $query->whereRaw('LOWER(title) LIKE ?', ["%".strtolower($search)."%"]);
            })
            ->when($propertyType, function ($query, $propertyType) {
                return $query->where('category', $propertyType);
            })
            ->when($location, function ($query, $location) {
                return $query->whereRaw('LOWER(location) LIKE ?', ["%".strtolower($location)."%"]);
            })
            ->latest()
            ->paginate(9)
            ->withQueryString(); // Keep filters in pagination
    
        // Fetch bookmarked properties for authenticated tenants
        $bookmarkedProperties = auth()->check() && auth()->user()->role === 'tenant'
            ? auth()->user()->bookmarks()->pluck('property_id')->toArray()
            : [];
    
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
