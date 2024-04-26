<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\video;
use App\Models\vote_video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteVideoController extends Controller
{
    public function voteVideo(Request $request, $id){
        $user_id = auth()->user()->id;
        $checkVote = vote_video::where('user_id', $user_id)->where('video_id', $id)->where('vote', $request->vote)->first();
        $checkAllVotes = vote_video::where('user_id', $user_id)->where('video_id', $id)->first();
        $video_user = video::find($id);
        $video_user = $video_user->user_id;
        $message = 'New vote for your video by ' . $request->vote . ' reaction';
        if(isset($checkVote)){
            $checkVote->delete();
        } elseif(isset($checkAllVotes)){
            $checkAllVotes->delete();
            vote_video::create([
                'user_id' => $user_id,
                'video_id' => $id,
                'vote' => $request->vote,
            ]);
            Notification::create([
                'user_id' => $video_user,
                'message' => $message,
                'sender_id' => auth()->user()->id,
                'type' => 'video',
                'data_id' => $id,
            ]);
        } else {
            vote_video::create([
                'user_id' => $user_id,
                'video_id' => $id,
                'vote' => $request->vote,
            ]);
            Notification::create([
                'user_id' => $video_user,
                'message' => $message,
                'sender_id' => auth()->user()->id,
                'type' => 'video',
                'data_id' => $id,
            ]);
        }
        return response()->json([
            'msg' => 'voted successfully',
        ]);
    }
    public function deleteVideo($id){
        $video = video::find($id);
        $votesVideo = vote_video::where('video_id', $video->id);
        if($video->user_id == Auth::user()->id){
            $votesVideo->delete();
            $video->delete();
        }
        return redirect()->back();
    }
}
