<?php
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\ActivityLog;


class OwnerPropertyController extends Controller
{
    public function index(Request $request)
{
    $query = Property::where('owner_id', Auth::id()); // Apply owner filter

    if ($request->has('search') && !empty($request->search)) {
        $searchTerm = $request->search;
        $query->where(function ($q) use ($searchTerm) {
            $q->where('title', 'LIKE', "%{$searchTerm}%")
              ->orWhere('location', 'LIKE', "%{$searchTerm}%")
              ->orWhere('price', 'LIKE', "%{$searchTerm}%");
        });
    }

    $properties = $query->latest()->paginate(10);
    return view('owner.properties.index', compact('properties'));
}


    public function create()
    {
        return view('owner.properties.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'location' => 'required|string|max:255',
        'property_type' => 'required|in:Apartment,Commercial,House,Land',
        'status' => 'required|in:Available,Rented,Sold',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    try {
        $imagePath = $request->file('image') ? $request->file('image')->store('properties', 'public') : null;

        Property::create([
            'owner_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'property_type' => $request->property_type, 
            'status' => $request->status,
            'image' => $imagePath,
        ]);
        ActivityLog::log('Created Property', 'A new property was added by Owner #' . auth()->id());

        return redirect()->route('owner.properties.index')->with('success', 'Property added successfully.');
    } catch (\Exception $e) {
        return back()->with('error', 'Something went wrong! ' . $e->getMessage());
    }
}


    public function edit(Property $property)
    {
       // Check if the logged-in user is the owner of the property
    if (auth()->user()->id !== $property->owner_id) {
        abort(403, 'You are not authorized to edit this property.');
    }
        return view('owner.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
 // Ensure only the owner can update this property
 if (auth()->user()->id !== $property->owner_id) {
    abort(403, 'You are not authorized to update this property.');
}
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'location' => 'required|string|max:255',
            'property_type' => 'required|in:Apartment,Commercial,House,Land',
            'status' => 'required|in:Available,Rented,Sold',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($property->image) {
                Storage::delete('public/' . $property->image);
            }
            $property->image = $request->file('image')->store('properties', 'public');
            $property->save();
        }

        $property->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'location' => $request->location,
            'property_type' => $request->property_type,
            'status' => $request->status,
        ]);
        return redirect()->route('owner.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    { // Ensure only the owner can update this property
        if (auth()->user()->id !== $property->owner_id) {
            abort(403, 'You are not authorized to update this property.');
        }
        if ($property->image) {
            Storage::delete('public/' . $property->image);
        }
        $property->delete();

        return redirect()->route('owner.properties.index')->with('success', 'Property deleted successfully.');
    }
}
