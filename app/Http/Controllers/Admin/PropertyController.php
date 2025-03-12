<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;

class PropertyController extends Controller
{
    // Display all properties
    public function index()
    {
        $properties = Property::all();
        return view('admin.properties.index', compact('properties'));
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
