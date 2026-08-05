<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('notification.index', compact('notifications'));
    }

    public function read(Notification $notification)
    {
        abort_if($notification->user_id != auth()->id(), 403);

        $notification->update([
            'is_read' => true
        ]);

        return back();
    }

    public function readAll()
    {
        Notification::where('user_id', auth()->id())
            ->update([
                'is_read' => true
            ]);

        return back();
    }
}