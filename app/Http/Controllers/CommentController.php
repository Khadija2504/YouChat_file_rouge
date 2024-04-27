<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentVote;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment(Request $request, $id){
        $request->validate([
            'description' => 'required',
        ]);
        $post_user = Post::find($id)->user_id;
        $message = 'New comment for your post.';
        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'description' => $request->description,
        ]);
        Notification::create([
            'user_id' => $post_user,
            'message' => $message,
            'sender_id' => auth()->user()->id,
            'type' => 'post',
            'data_id' => $id,
        ]);
        return redirect()->back();
    }
     public function deleteComment($id){
        $comment = Comment::where('id', $id);
        $comment_votes = CommentVote::where('comment_id', $id);
        if(isset($comment_votes)){
            $comment_votes->delete();
        }
        $comment->delete();
        return response()->json([
            'mag' => 'comment deleted successfully',
        ]);
     }
}