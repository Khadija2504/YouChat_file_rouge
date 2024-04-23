<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\Reel;
use App\Models\video;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(){
        $unraedNotification = Notification::where('user_id', auth()->user()->id);
        $notifications = Notification::where('user_id', auth()->user()->id)->with('sender')->orderBy('created_at', 'desc')->get();
        $unraedNotification->update([
            'is_read' => 1,
        ]);
        return view('notifications.notifications',compact('notifications'));
    }
    public function readPost($id){
        $post = Post::find($id);
        return view('notifications.readPost', compact('post'));
    }
    public function readVideo($id){
        $videos = video::find(1);
        return view('notifications.readVideo', compact('videos'));
    }
    public function unreadNotifications(){
        $notifications = Notification::where('user_id', auth()->user()->id)->where('is_read', 0)->count();
        return response()->json([
            'msg' => 'You have new notifications',
            'notifications' => $notifications,
        ]);
    }
    public function readreel($id){
        $reels = Reel::find($id);
        return view('notifications.readReel', compact('reels'));
    }
}
