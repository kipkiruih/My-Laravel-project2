<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    // Display all properties
    public function index(Request $request)
{
    $query = Property::query()->with('owner');

    // Searching
    if ($request->has('search')) {
        $search = $request->search;
        $query->where('title', 'like', "%{$search}%")
              ->orWhereHas('owner', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              })
              ->orWhere('property_type', 'like', "%{$search}%");
    }

    // Sorting
    $sortColumn = $request->get('sort', 'title'); // Default sort by title
    $sortDirection = $request->get('direction', 'asc'); // Default direction ascending

    $properties = $query->orderBy($sortColumn, $sortDirection)->paginate(10);

    return view('admin.properties.index', compact('properties', 'sortColumn', 'sortDirection'));
}


    // Show edit form
    public function edit($id)
    {
        $property = Property::findOrFail($id);
        return view('admin.properties.edit', compact('property'));
    }

    // Update property details
    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);
        $property->update($request->all());
       

        return redirect()->route('admin.properties.index')->with('success', 'Property updated successfully.');
    }

    // Approve property listing
    public function approve($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'approved';
        $property->save();

        return redirect()->back()->with('success', 'Property approved successfully.');
    }

    // Reject property listing
    public function reject($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'rejected';
        $property->save();

        return redirect()->back()->with('success', 'Property rejected successfully.');
    }

    // Delete property
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return redirect()->route('admin.properties.index')->with('success', 'Property deleted successfully.');
    }
}
