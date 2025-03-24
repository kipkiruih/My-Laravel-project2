<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Notifications\TenantReviewNotification;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    
    public function store(Request $request, $propertyId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'property_id' => $propertyId,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Review submitted successfully.');
    }

    public function update(Request $request, $id)
{
    $review = Review::findOrFail($id);

    // Ensure only the owner of the review can update it
    if (auth()->id() !== $review->user_id) {
        abort(403, 'Unauthorized action.');
    }

    // Validate request
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'nullable|string|max:500',
    ]);

    // Update review
    $review->update([
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    return redirect()->route('properties.show', $review->property_id)
                     ->with('success', 'Review updated successfully.');
}

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
    
        $review->delete();
    
        return back()->with('success', 'Review deleted successfully.');
    }

    public function edit($id)
{
    $review = Review::findOrFail($id);

    // Ensure the authenticated user can only edit their own review
    if (auth()->id() !== $review->user_id) {
        return redirect()->back()->with('error', 'Unauthorized access.');
    }

    return view('review.edit', compact('review'));
}

    
}
