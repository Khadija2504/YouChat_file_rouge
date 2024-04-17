<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoryRequest;
use App\Models\FriendsList;
use App\Models\Story;
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
        return view('displayFriendStories', compact('id'));
    }
    public function displayFriendStories($id) {
        $stories = Story::where('user_id', $id)->with('users')->latest()->limit(4)->get();
        $stories->transform(function ($story) {
            if ($story->users) {
                $story->users->avatar_url = asset('' . $story->users->avatar);
                $story->dataStory_url = asset('' . $story->data_Story);
                $videoExtensions = ['mp4', 'mov', 'avi', 'mkv', 'flv', 'wmv'];
                $story->is_video = in_array(strtolower(pathinfo($story->data_Story, PATHINFO_EXTENSION)), $videoExtensions);                
            }
            return $story;
        });
        return response()->json([
            'success' => true,
            'stories' => $stories,
        ]);
        
    }
    public function displayAvatarStories() {
        $friendIds = FriendsList::where('user_id', Auth::user()->id)->pluck('friend_id');
        $stories = Story::whereIn('user_id', $friendIds)->with(['users' => function($query){
                            $query->select('id', 'avatar');
                        }])->latest()->take(4)->get();
    
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
        ]);
    }
    
    
}
