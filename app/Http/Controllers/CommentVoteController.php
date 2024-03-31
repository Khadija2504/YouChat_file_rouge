<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentVoteController extends Controller
{
    public function commentVote(Request $request, $id){
        $checkVote = CommentVote::where('user_id', auth()->id())->where('vote', $request->vote)->where('comment_id', $id)->first();
        $checkDislikVote = CommentVote::where('user_id', auth()->id())->where('comment_id', $id)->first();
        $comment = Comment::find($id);
        $message = 'New vote for your comment'. Auth::user()->name . $request->vote . 's your comment';
        if(isset($checkVote)){
            $checkVote->delete();
        } elseif(isset($checkDislikVote)){
            $checkDislikVote->delete();
            CommentVote::create([
                'user_id' => auth()->id(),
                'comment_id' => $id,
                'vote' => $request->vote,
            ]);
            Notification::create([
                'user_id' => $comment->user_id,
                'message' => $message,
                'sender_id' => auth()->user()->id,
                'type' => 'post',
                'data_id' => $comment->post_id,
            ]);
        } else{
            CommentVote::create([
                'user_id' => auth()->id(),
                'comment_id' => $id,
                'vote' => $request->vote,
            ]);
            Notification::create([
                'user_id' => $comment->user_id,
                'message' => $message,
                'sender_id' => auth()->user()->id,
                'type' => 'post',
                'data_id' => $comment->post_id,
            ]);
        }
        return redirect()->back();
    }
    
}
