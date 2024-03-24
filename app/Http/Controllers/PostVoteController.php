<?php

namespace App\Http\Controllers;

use App\Models\PostVote;
use Illuminate\Http\Request;

class PostVoteController extends Controller
{
    public function likePost($id){
        $checkVote = PostVote::where('user_id', auth()->id())->where('vote', 'like')->where('post_id', $id)->first();
        $checkDislikVote = PostVote::where('user_id', auth()->id())->where('vote', 'dislike')->where('post_id', $id)->first();
        // foreach($checkVote as $check){
            // dd($checkVote);
        // }
        
        if(isset($checkVote)){
            $checkVote->delete();
        } elseif(isset($checkDislikVote)){
            $checkDislikVote->delete();
            PostVote::create([
                'user_id' => auth()->id(),
                'post_id' => $id,
                'vote' => 'like',
            ]);
        } else{
            PostVote::create([
                'user_id' => auth()->id(),
                'post_id' => $id,
                'vote' => 'like',
            ]);
        }
    // }
        return redirect()->back();
    }
    
    // dislikes post

    public function dislikePost($id){
        $checkVote = PostVote::where('user_id', auth()->id())->where('vote', 'dislike')->where('post_id', $id)->first();
        $checkLikeVote = PostVote::where('user_id', auth()->id())->where('vote', 'like')->where('post_id', $id)->first();
        if(isset($checkVote)){
            $checkVote->delete();
        } elseif(isset($checkLikeVote)){
            $checkLikeVote->delete();
            PostVote::create([
                'user_id' => auth()->id(),
                'post_id' => $id,
                'vote' => 'dislike',
            ]);
        } else {
            PostVote::create([
                'user_id' => auth()->id(),
                'post_id' => $id,
                'vote' => 'dislike',
            ]);
        }
        return redirect()->back();
    }
}
