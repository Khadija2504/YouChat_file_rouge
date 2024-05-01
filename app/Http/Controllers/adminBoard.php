<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchPost;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reel;
use App\Models\User;
use App\Models\video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminBoard extends Controller
{
    public function dashboard(){
        $usersCount = User::count();
        $banUsers = User::where('ban', true)->count();
        $posts = Post::withCount('comments');
        $postsCount = Post::count();
        $videosCount = video::count();
        $reelsCount = Reel::count();

        $postWithALotOfComments = $posts->first();
        $userWithALotOfFollowers = User::withCount('followers')->get()->sortByDesc('followers_count')->take(5);

        return view('admin.dashboard', compact('postWithALotOfComments', 'banUsers', 'usersCount', 'postsCount', 'videosCount', 'reelsCount', 'userWithALotOfFollowers'));
    }
    public function usersList(){
        $users = User::with('comments', 'posts')->paginate(6);
        return view('admin.usersList', compact('users'));
    }
    public function profileUser($id){
        $users = User::with('comments', 'followers', 'posts', 'videos', 'reels', 'events')->find($id);
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
