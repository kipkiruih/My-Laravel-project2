<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('tenant_id', auth()->id())->with('property')->get();
        return view('tenant.favorites.index', compact('favorites'));
    }

    public function store(Request $request)
    {
        $request->validate(['property_id' => 'required|exists:properties,id']);

        Favorite::firstOrCreate([
            'tenant_id' => auth()->id(),
            'property_id' => $request->property_id
        ]);

        return back()->with('success', 'Property added to favorites!');
    }

    public function destroy($id)
    {
        Favorite::where('tenant_id', auth()->id())->where('property_id', $id)->delete();
        return back()->with('success', 'Property removed from favorites.');
    }
    
}

