<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Mailer\Event\MessageEvent;

class MessageController extends Controller
{
    public function addMessage(MessageRequest $requset){
        $validated = $requset->validated();
        $message = Message::create($validated);
        return response()->json([
            'seccess' => true,
            'message' => $message,
            'msg' => 'Message added successfully',
        ]);
    }
    public function displayMessages($id){
        $messages = Message::where('chat_id', $id)->with('from_user', 'to_user')->get();
        $unread = Message::where('chat_id', $id)->where('is_read', 0)->first();
        $unreadMessages = Message::where('chat_id', $id)->where('is_read', 0)->whereNot('from_id', Auth::user()->id);
        $conversation = ChatRoom::with('users', 'friends')->find($id);
        if(isset($unread)){
            $unreadMessages->update([
                'is_read' => 1,
            ]);
        }
        return response()->json([
            'seccess' => true,
            'messages' => $messages,
            'conversation' => $conversation,
        ]);
    }
    public function deleteMessage($id){
        $message = Message::where('id', $id);
        $message->delete();
        return response()->json([
            'seccess' => true,
            'msg' => 'Message deleted successfully',
        ]);
    }

    public function unreadConversations(){
        $conversations = ChatRoom::where('user_id', Auth::user()->id)->with('messages')->get();
        $unreadMessage = [];
        foreach($conversations as $conversation){
            $unreadMessage[] = $conversation->messages->whereNot('from_id', Auth::user()->id)->where('is_read', 0)->count();
        }
        return response()->json([
            'unreadMessages' => $unreadMessage,
            'msg' => 'unread messages count',
        ]);
    }
}
