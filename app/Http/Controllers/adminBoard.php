<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchPost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminBoard extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }
    public function usersList(){
        $users = User::with('comments', 'posts')->paginate(6);
        return view('admin.usersList', compact('users'));
    }
    public function profileUser($id){
        $users = User::with('comments', 'followers', 'posts', 'videos', 'reels', 'events')->find($id);
        // dd($users);
        return view('admin.profileUser', compact('users'));
    }
    public function banner($id){
        $user = User::find($id);
        if($user->ban == false){
            $user->ban = true;
            $user->save();
        } else{
            $user->ban = false;
            $user->save();
        }
        return response()->json([
            'msg' => 'user banner successfully',
        ]);
    }
    public function searchUsers(SearchPost $request){
        $search = $request->search;
        $users = User::where('name', 'like', '%'.$search.'%')->get();
        $users->transform(function($user){
            $user->avatar_url = asset(''. $user->avatar);
            $user->profile_url = route('profileUser', $user->id);
            $user->ban_url = route('banner', $user->id);
            $user->comments_count = $user->comments->count();
            return $user;
        });
        return response()->json([
            'msg' => 'users displayed sucessfully',
            'users' => $users,
        ]);
    }

}
