<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string'
        ]);

        Rating::updateOrCreate(
            ['tenant_id' => auth()->id(), 'property_id' => $request->property_id],
            ['rating' => $request->rating, 'review' => $request->review]
        );

        return back()->with('success', 'Review submitted successfully!');
    }
}

