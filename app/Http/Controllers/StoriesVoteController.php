<?php

namespace App\Http\Controllers;

use App\Models\stories_vote;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoriesVoteController extends Controller
{
    public function votesStory($id){
        $story = stories_vote::where('user_id', Auth::user()->id)->where('story_id', $id)->first();
        $votesCount = Story::find($id);
        if(!isset($story)){
            $voteData = stories_vote::create([
                'user_id' => Auth::user()->id,
                'story_id' => $id,
            ]);
            return response()->json([
                'success' => true,
                'msg' => 'story voted successfully',
                'data' => $voteData,
                'votesCount' => $votesCount->votesStories->count(),
            ]);
        } else{
            $story->delete();
            return response()->json([
                'success' => false,
                "msg" =>"story's vote deleted successfully",
                'votesCount' => $votesCount->votesStories->count(),
            ]);
        }
    }
    public function deleteStory($id){
        $story = Story::where('id', $id);
        $story->delete();
        return redirect()->back();
    }
}
