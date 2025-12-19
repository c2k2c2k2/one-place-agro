<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display a listing of user's notifications.
     */
    public function index(): View
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        // Mark all as read when viewing the notifications page
        Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a specific notification as read.
     */
    public function markAsRead(Notification $notification): RedirectResponse
    {
        // Ensure the notification belongs to the authenticated user
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this notification.');
        }

        $notification->update(['is_read' => true]);

        return back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): RedirectResponse
    {
        $user = Auth::user();

        Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Get unread notification count (for badge).
     */
    public function unreadCount(): JsonResponse
    {
        $user = Auth::user();

        $count = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Get recent notifications (for dropdown).
     */
    public function recent(): JsonResponse
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'type' => $notification->type,
                    'is_read' => $notification->is_read,
                    'created_at' => $notification->created_at->diffForHumans(),
                ];
            });

        return response()->json($notifications);
    }

    /**
     * Delete a notification.
     */
    public function destroy(Notification $notification): RedirectResponse
    {
        // Ensure the notification belongs to the authenticated user
        if ($notification->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this notification.');
        }

        $notification->delete();

        return back()->with('success', 'Notification deleted successfully.');
    }

    /**
     * Delete all read notifications.
     */
    public function clearRead(): RedirectResponse
    {
        $user = Auth::user();

        Notification::where('user_id', $user->id)
            ->where('is_read', true)
            ->delete();

        return back()->with('success', 'All read notifications cleared.');
    }
}
