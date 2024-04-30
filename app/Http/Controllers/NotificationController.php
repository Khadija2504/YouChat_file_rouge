<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\FriendsList;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Reel;
use App\Models\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifications(){
        $unraedNotification = Notification::where('user_id', auth()->user()->id);
        $isFollowed = FriendsList::where('user_id', Auth::id())->first();
        $notifications = Notification::where('user_id', auth()->user()->id)->with('sender')->orderBy('created_at', 'desc')->take(8)->get();
        $unraedNotification->update([
            'is_read' => 1,
        ]);
        return view('notifications.notifications',compact('notifications', 'isFollowed'));
    }
    public function displayMoreNotifications(Request $request) {
        $offset = $request->input('offset', 0);
        $limit = $request->input('limit', 4);

        $unraedNotification = Notification::where('user_id', auth()->user()->id);
        $isFollowed = FriendsList::where('user_id', Auth::id())->first();
        $notifications = Notification::where('user_id', auth()->user()->id)->with('sender')->skip($offset)->take($limit)->orderBy('created_at', 'desc')->take(8)->get();
        $unraedNotification->update([
            'is_read' => 1,
        ]);
        
        $html = view('notifications.notifications_partial', compact('notifications', 'isFollowed'))->render();
    
        return response()->json(['html' => $html, 'notifications' => $notifications]);
    }

    public function deleteNotification($id){
        $notifications = Notification::find($id);
        $notifications->delete();
        return response()->json([
           'seccess' => true,
           'msg' => 'Notifications deleted successfully',
        ]);
    }

    public function readPost($id){
        $conversations = ChatRoom::where('user_id', Auth::user()->id)->orWhere('friend_id', Auth::user()->id)
                        ->with('friends', 'users', 'messages')->orderBy('created_at', 'desc')->get();
        $isFollowed = FriendsList::where('user_id', Auth::id())->first();
        $post = Post::find($id);
        return view('notifications.readPost', compact('post', 'conversations', 'isFollowed'));
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
