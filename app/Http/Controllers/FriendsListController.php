<?php

namespace App\Http\Controllers;

use App\Models\FriendsList;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendsListController extends Controller
{
    public function follow($id){
        $message = 'New follower';
        if(Auth::user()->acceptation == 'auto'){
            FriendsList::create([
                'user_id' => Auth::user()->id,
                'friend_id' => $id,
                'status' => 'valid',
            ]);
        } else{
            FriendsList::create([
                'user_id' => Auth::user()->id,
                'friend_id' => $id,
                'status' => 'invalid',
            ]);
        }
        Notification::create([
            'user_id' => $id,
            'message' => $message,
            'sender_id' => auth()->user()->id,
            'type' => 'follower',
            'data_id' => 'no data',
        ]);
        return redirect()->back()->with('message', 'the user has been followed successfully');
    }

    public function listFollowers(){
        $followers = FriendsList::where('user_id', Auth::user()->id)->get();
        return view('users/list_followers', compact('followers'));
    }

    public function acceptation(Request $request, $id){
        // dd($request);
        $validated = $request->validate([
            'status' => 'required',
        ]);
        $friendsList = FriendsList::where('id', $id);
        $friendsList->update($validated);
        $message = auth()->user()->name . 'is accepted you as a foller';
        Notification::create([
            'user_id' => $friendsList->friend_id,
            'message' => $message,
            'sender_id' => auth()->user()->id,
            'type' => 'follower',
            'data_id' => $id,
        ]);
        return redirect()->back()->with('message', 'The user has been accepted successfully');
    }
    public function blocke($id){
        $friendsList = FriendsList::where('user_id', Auth::user()->id)->where('friend_id', $id);
        $friendsList->update([
            'blocked' => 1,
        ]);
        return redirect()->back()->with('message', 'The user has been blocked successfully');
    }
}
