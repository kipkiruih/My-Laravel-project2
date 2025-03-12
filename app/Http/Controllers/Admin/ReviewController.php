<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    // Display all reviews
    public function index()
    {
        $reviews = Review::with(['tenant', 'property', 'owner'])->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    // Show review details
    public function show($id)
    {
        $review = Review::with(['tenant', 'property', 'owner'])->findOrFail($id);
        return view('admin.reviews.show', compact('review'));
    }

    // Delete inappropriate review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Review removed successfully.');
    }
}
