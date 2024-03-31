<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{
    public function postVote(Request $request, $id){
        $checkVote = PostVote::where('user_id', auth()->id())->where('vote', $request->vote)->where('post_id', $id)->first();
        $checkDislikVote = PostVote::where('user_id', auth()->id())->where('post_id', $id)->first();
        $post_user = Post::find($id)->user_id;
        $message = 'New vote for your post, ' . auth()->user()->name . ' ' . $request->vote . 's your post';
        if(isset($checkVote)){
            $checkVote->delete();
        } elseif(isset($checkDislikVote)){
            $checkDislikVote->delete();
            PostVote::create([
                'user_id' => auth()->id(),
                'post_id' => $id,
                'vote' => $request->vote,
            ]);
            Notification::create([
                'user_id' => $post_user,
                'message' => $message,
                'sender_id' => auth()->user()->id,
                'type' => 'post',
                'data_id' => $id,
            ]);
        } else{
            PostVote::create([
                'user_id' => auth()->id(),
                'post_id' => $id,
                'vote' => $request->vote,
            ]);
            Notification::create([
                'user_id' => $post_user,
                'message' => $message,
                'sender_id' => auth()->user()->id,
                'type' => 'post',
                'data_id' => $id,
            ]);
        }
        return redirect()->back();
    }
    
}
