<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\video;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications(){
        $notifications = Notification::where('user_id', auth()->user()->id)->with('sender')->orderBy('created_at', 'desc')->get();
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
}
