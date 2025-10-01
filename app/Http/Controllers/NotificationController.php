<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()
            ->latest()
            ->paginate(20);
        
        return view('notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->markAsRead();
        
        return response()->json(['success' => true]);
    }

    public function markAllAsRead()
    {
        Auth::user()->unreadNotifications()->update([
            'is_read' => true,
            'read_at' => now()
        ]);
        
        return response()->json(['success' => true]);
    }

    public function getUnreadCount()
    {
        $count = Auth::user()->unreadNotifications()->count();
        
        return response()->json(['count' => $count]);
    }

    public function getRecentNotifications()
    {
        $notifications = Auth::user()->notifications()
            ->latest()
            ->limit(5)
            ->get();
        
        return response()->json($notifications);
    }
}