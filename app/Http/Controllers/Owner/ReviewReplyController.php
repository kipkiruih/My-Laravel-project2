<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReviewReply;
use App\Models\Review;
use App\Notifications\ReviewReplyNotification;  

class ReviewReplyController extends Controller
{
    
public function store(Request $request)
{
    $request->validate([
        'review_id' => 'required|exists:reviews,id',
        'reply' => 'required|string',
    ]);

    $reply = ReviewReply::create([
        'review_id' => $request->review_id,
        'user_id' => auth()->id(),
        'reply' => $request->reply,
    ]);

    // Notify the tenant when an owner replies
    $review = $reply->review;
    $tenant = $review->tenant;
    $tenant->notify(new ReviewReplyNotification($reply));

    return back()->with('success', 'Reply submitted successfully.');
}
}
