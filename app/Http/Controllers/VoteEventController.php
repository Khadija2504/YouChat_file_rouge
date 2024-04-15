<?php

namespace App\Http\Controllers;

use App\Models\Evenement;
use App\Models\Notification;
use App\Models\VoteEvent;
use Illuminate\Http\Request;

class VoteEventController extends Controller
{
    public function voteEvent(Request $request, $id){
        $user_id = auth()->user()->id;
        $checkVote = VoteEvent::where('user_id', $user_id)->where('evenement_id', $id)->where('vote', $request->vote)->first();
        $checkAllVotes = VoteEvent::where('user_id', $user_id)->where('evenement_id', $id)->first();
        $video_user = Evenement::find($id)->user_id;
        $message = 'New vote for your event by ' . $request->vote . ' reaction';
        if(isset($checkVote)){
            $checkVote->delete();
        } elseif(isset($checkAllVotes)){
            $checkAllVotes->delete();
            $VoteEvent = VoteEvent::create([
                'user_id' => $user_id,
                'evenement_id' => $id,
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
            $VoteEvent = VoteEvent::create([
                'user_id' => $user_id,
                'evenement_id' => $id,
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
        // return response()->json([
        //     'seccess' => true,
        //     'msg' => 'vote created successfully',
        //     'itineraire' => $VoteEvent,
        // ]);
        return redirect()->back();
    }
}
