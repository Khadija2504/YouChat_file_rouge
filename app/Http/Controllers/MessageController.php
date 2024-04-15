<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return response()->json([
            'seccess' => true,
            'messages' => $messages,
        ]);
    }
}
