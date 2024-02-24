<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notification;

class NotificationController extends Controller
{
    /**
     * Show the form to send notification.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm()
    {
        return view('adminnotifications');
    }

    /**
     * Send notification to all users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendNotification(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);
    
        // Create a single notification instance
        $notification = new Notification([
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
    
        // Save the notification
        $notification->save();
    
        // Notification sent successfully
        return response()->json(['message' => 'Notification sent successfully']);
    }
    
    public function showNotifications(Request $request)
    {
        // Retrieve all notifications
        $notifications = Notification::all();
    
     
    
        // If it's not a JSON request, return the view
        return view('user.showNotifications', compact('notifications'));
    }
    
    
  
}
