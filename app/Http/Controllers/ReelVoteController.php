<?php

namespace App\Http\Controllers;

use App\Models\Reel;
use App\Models\Reel_vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReelVoteController extends Controller
{
    public function voteReel($id){
        $reel = Reel_vote::where('reel_id', $id)->where('user_id', Auth::user()->id)->first();
        if(!isset($reel)){
            $voteData = Reel_vote::create([
                'user_id' => Auth::user()->id,
                'reel_id' => $id,
                'voted' => true,
            ]);
            return response()->json([
                'success' => true,
                'msg' => 'reel voted successfully',
                'data' => $voteData,
            ]);
        } else{
            $reel->delete();
            return response()->json([
                'success' => false,
               "msg" =>"reel's vote deleted successfully",
            ]);
        }
        
    }
}
