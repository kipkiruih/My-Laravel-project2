<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function index()
    {
        // Fetch notifications for the logged-in user
        $notifications = auth()->user()->notifications;

        // Mark all notifications as read when the page is accessed
        auth()->user()->unreadNotifications->markAsRead();

        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return response()->json(['success' => true]);
    }
}

