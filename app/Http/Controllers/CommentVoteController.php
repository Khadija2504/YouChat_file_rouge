<?php

namespace App\Http\Controllers;

use App\Models\CommentVote;
use Illuminate\Http\Request;

class CommentVoteController extends Controller
{
    public function likeComment($id){
        $checkVote = CommentVote::where('user_id', auth()->id())->where('vote', 'like')->where('comment_id', $id)->first();
        $checkDislikVote = CommentVote::where('user_id', auth()->id())->where('vote', 'dislike')->where('comment_id', $id)->first();
        
        if(isset($checkVote)){
            $checkVote->delete();
        } elseif(isset($checkDislikVote)){
            $checkDislikVote->delete();
            CommentVote::create([
                'user_id' => auth()->id(),
                'comment_id' => $id,
                'vote' => 'like',
            ]);
        } else{
            CommentVote::create([
                'user_id' => auth()->id(),
                'comment_id' => $id,
                'vote' => 'like',
            ]);
        }
        return redirect()->back();
    }
    
    public function dislikeComment($id){
        $checkVote = CommentVote::where('user_id', auth()->id())->where('vote', 'dislike')->where('comment_id', $id)->first();
        $checkLikeVote = CommentVote::where('user_id', auth()->id())->where('vote', 'like')->where('comment_id', $id)->first();
        if(isset($checkVote)){
            $checkVote->delete();
        } elseif(isset($checkLikeVote)){
            $checkLikeVote->delete();
            CommentVote::create([
                'user_id' => auth()->id(),
                'comment_id' => $id,
                'vote' => 'dislike',
            ]);
        } else {
            CommentVote::create([
                'user_id' => auth()->id(),
                'comment_id' => $id,
                'vote' => 'dislike',
            ]);
        }
        return redirect()->back();
    }
}
