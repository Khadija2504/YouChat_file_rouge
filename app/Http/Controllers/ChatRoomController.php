<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatRoomController extends Controller
{
    public function chatRoom(){
        return view('chat.chatRoom');
    }

    public function conversations() {
        $conversations = ChatRoom::where('user_id', Auth::user()->id)
                                ->orWhere('friend_id', Auth::user()->id)
                                ->with('friends', 'users', 'messages')
                                ->orderBy('created_at', 'desc')
                                ->get();
    
        $unreadMessages = [];
        foreach ($conversations as $conversation) {
            $unreadMessageCount = $conversation->messages
                ->where('from_id', '!=', Auth::user()->id)
                ->where('is_read', 0)
                ->count();
    
            $unreadMessages[$conversation->id] = $unreadMessageCount;
        }
    
        return response()->json([
            'conversations' => $conversations,
            'unreadMessages' => $unreadMessages,
        ]);
    }
    
    public function createconversation($id){
        $conversation = ChatRoom::where('user_id', Auth::user()->id)->where('friend_id', $id)->first();
        if(isset($conversation->id)){
            return response()->json([
                'conversation' => $conversation,
            ]);
        } else{
            $conversation = ChatRoom::create([
                'user_id' => Auth::user()->id,
                'friend_id' => $id,
            ]);
            return redirect()->route('chatRoom');
        }
    }
    public function unreadMessages(){
        $messages = Message::whereNot('from_id', Auth::user()->id)->where('is_read', 0)->count();
        return response()->json([
            'messages' => $messages,
            'msg' => 'you have a new messages',
        ]);
    }
}
