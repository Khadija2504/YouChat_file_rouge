<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\ChatRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    public function chatRoom(){
        return view('chat.chatRoom');
    }

    public function conversations(){
        $conversations = ChatRoom::where('user_id', Auth::user()->id)->orWhere('friend_id', Auth::user()->id)->with('friends', 'users')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'conversations' => $conversations,
        ]);
    }
}
