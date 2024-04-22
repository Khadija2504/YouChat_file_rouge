<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryRequest;
use App\Models\FriendsList;
use App\Models\Story;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryController extends Controller
{
    public function addStory(StoryRequest $request){
        $validated = $request->validated();
        if ($request->hasFile('data_Story')) {
            $file = $request->file('data_Story');
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $path = 'data_Stories/';
            $file->move($path, $file_name);
            $validated['data_Story'] = $path . '/' . $file_name;
        }
        $story = Story::create($validated);
        return redirect()->back();
    }

    public function displayStories($id){
        $storiesUp = Story::where('user_id', $id)->where('created_at', '>=', Carbon::now()->subHours(24))->where('is_raed', 0)->update(['is_raed' => 1]);
        $stories = Story::where('user_id', $id)->where('created_at', '>=', Carbon::now()->subHours(24))->with(['users', 'votesStories'])->latest()->limit(4)->get();
        $videoExtensions = ['mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv'];
        return view('displayFriendStories', compact('stories', 'videoExtensions'));
    }
    
    public function displayAvatarStories() {
        $friendIds = FriendsList::where('user_id', Auth::user()->id)->pluck('friend_id');
        
        $stories = Story::whereIn('user_id', $friendIds)
                        ->where('created_at', '>=', Carbon::now()->subHours(24))
                        ->with('users')
                        ->latest()
                        ->take(10)
                        ->get();
    
        $stories->transform(function ($story) {
            if ($story->users) {
                $story->users->avatar_url = asset('' . $story->users->avatar);
                $story->userId = route('displayStories', $story->user_id);
            }
            return $story;
        });
    
        return response()->json([
            'success' => true,
            'stories' => $stories,
            'storiesCount' =>$stories->where('is_raed', 0)->count(),
        ]);
    }
    
    
    
}
