<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Notifications\TenantReviewNotification;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review =  Review::create([
            'tenant_id' => auth()->id(),
            'property_id' => $request->property_id,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);// Notify the property owner
        $property = $review->property;
        if ($property->owner) {
            $property->owner->notify(new TenantReviewNotification($review));
        }
    


        return back()->with('success', 'Review submitted successfully.');
    }

    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $request->validate(['review' => 'required|string']);

        $review->update(['review' => $request->review]);

        return back()->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        
        $review->delete();

        return back()->with('success', 'Review deleted successfully.');
    }
}
